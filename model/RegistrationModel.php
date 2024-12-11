<?php

/**
 * Class RegistrationModel
 *
 * Everything registration-related happens here.
 */
class RegistrationModel
{
    /**
     * Handles the entire registration process for DEFAULT users (not for people who register with
     * 3rd party services, like facebook) and creates a new user in the database if everything is fine
     *
     * @return boolean Gives back the success status of the registration
     */
    public static function registerNewUser()
    {
        // clean the input
        $user_name = strip_tags(Request::post('user_name'));
        $user_email = strip_tags(Request::post('user_email'));
        $user_email_repeat = strip_tags(Request::post('user_email_repeat'));
        $user_password_new = Request::post('user_password_new');
        $user_password_repeat = Request::post('user_password_repeat');

        // stop registration flow if registrationInputValidation() returns false
        $validation_result = self::registrationInputValidation(
            Request::post('captcha'),
            $user_name,
            $user_password_new,
            $user_password_repeat,
            $user_email,
            $user_email_repeat
        );

        if (!$validation_result) {
            return false;
        }

        // hash the password
        $user_password_hash = password_hash($user_password_new, PASSWORD_DEFAULT);

        // make return a bool variable to track issues
        $return = true;

        // check if username already exists
        if (UserModel::doesUsernameAlreadyExist($user_name)) {
            Session::add('feedback_negative', Text::get('FEEDBACK_USERNAME_ALREADY_TAKEN'));
            $return = false;
        }

        // check if email already exists
        if (UserModel::doesEmailAlreadyExist($user_email)) {
            Session::add('feedback_negative', Text::get('FEEDBACK_USER_EMAIL_ALREADY_TAKEN'));
            $return = false;
        }

        // if there were validation issues, stop here
        if (!$return) return false;

        // write user data to the database
        if (!self::writeNewUserToDatabase($user_name, $user_password_hash, $user_email, time())) {
            Session::add('feedback_negative', Text::get('FEEDBACK_ACCOUNT_CREATION_FAILED'));
            return false;
        }

        // get user_id of the newly created user
        $user_id = UserModel::getUserIdByUsername($user_name);
        if (!$user_id) {
            Session::add('feedback_negative', Text::get('FEEDBACK_UNKNOWN_ERROR'));
            return false;
        }

        // add success feedback
        Session::add('feedback_positive', Text::get('FEEDBACK_ACCOUNT_SUCCESSFULLY_CREATED'));
        return true;
    }

    /**
     * Validates the registration input
     *
     * @param $captcha
     * @param $user_name
     * @param $user_password_new
     * @param $user_password_repeat
     * @param $user_email
     * @param $user_email_repeat
     *
     * @return bool
     */
    public static function registrationInputValidation($captcha, $user_name, $user_password_new, $user_password_repeat, $user_email, $user_email_repeat)
    {
        $return = true;

        // validate username, email, and password
        if (self::validateUserName($user_name)
            && self::validateUserEmail($user_email, $user_email_repeat)
            && self::validateUserPassword($user_password_new, $user_password_repeat)
            && $return) {
            return true;
        }

        return false;
    }

    /**
     * Validates the username
     *
     * @param $user_name
     * @return bool
     */
    public static function validateUserName($user_name)
    {
        if (empty($user_name)) {
            Session::add('feedback_negative', Text::get('FEEDBACK_USERNAME_FIELD_EMPTY'));
            return false;
        }

        if (!preg_match('/^[a-zA-Z0-9]{2,64}$/', $user_name)) {
            Session::add('feedback_negative', Text::get('FEEDBACK_USERNAME_DOES_NOT_FIT_PATTERN'));
            return false;
        }

        return true;
    }

    /**
     * Validates the email
     *
     * @param $user_email
     * @param $user_email_repeat
     * @return bool
     */
    public static function validateUserEmail($user_email, $user_email_repeat)
    {
        if (!empty($user_email) && !filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
            Session::add('feedback_negative', Text::get('FEEDBACK_EMAIL_DOES_NOT_FIT_PATTERN'));
            return false;
        }

        return true;
    }

    /**
     * Validates the password
     *
     * @param $user_password_new
     * @param $user_password_repeat
     * @return bool
     */
    public static function validateUserPassword($user_password_new, $user_password_repeat)
    {
        if (empty($user_password_new) || empty($user_password_repeat)) {
            Session::add('feedback_negative', Text::get('FEEDBACK_PASSWORD_FIELD_EMPTY'));
            return false;
        }

        if ($user_password_new !== $user_password_repeat) {
            Session::add('feedback_negative', Text::get('FEEDBACK_PASSWORD_REPEAT_WRONG'));
            return false;
        }

        if (strlen($user_password_new) < 6) {
            Session::add('feedback_negative', Text::get('FEEDBACK_PASSWORD_TOO_SHORT'));
            return false;
        }

        return true;
    }

    /**
     * Writes the new user's data to the database
     *
     * @param $user_name
     * @param $user_password_hash
     * @param $user_email
     * @param $user_creation_timestamp
     *
     * @return bool
     */
    public static function writeNewUserToDatabase($user_name, $user_password_hash, $user_email, $user_creation_timestamp)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "INSERT INTO users (user_name, user_password_hash, user_email, user_creation_timestamp, user_active, user_provider_type)
                VALUES (:user_name, :user_password_hash, :user_email, :user_creation_timestamp, 1, :user_provider_type)";

        $params = [
            ':user_name' => $user_name,
            ':user_password_hash' => $user_password_hash,
            ':user_email' => $user_email,
            ':user_creation_timestamp' => $user_creation_timestamp,
            ':user_provider_type' => 'DEFAULT'
        ];

        $query = $database->prepare($sql);
        if (!$query->execute($params)) {
            error_log("SQL Error: " . print_r($query->errorInfo(), true));
            return false;
        }

        return $query->rowCount() == 1;
    }

    /**
     * Deletes the user from users table. Currently used to rollback a registration when verification mail sending
     * was not successful.
     *
     * @param $user_id
     */
    public static function rollbackRegistrationByUserId($user_id)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $query = $database->prepare("DELETE FROM users WHERE user_id = :user_id");
        $query->execute([':user_id' => $user_id]);
    }
}
