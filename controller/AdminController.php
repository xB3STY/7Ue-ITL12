<?php

class AdminController extends Controller
{
    /**
     * Construct this object by extending the basic Controller class
     */
    public function __construct()
    {
        parent::__construct();

        // Sicherstellen, dass der Benutzer ein Admin ist
        if (Session::get('user_account_type') != 7) { // 7 steht hier für die Admin-Rolle
            Redirect::to('login/index');
        }
    }

    /**
     * Zeigt die Hauptseite des Admins
     */
    public function index()
    {
        $this->View->render('admin/index', array(
            'users' => UserModel::getPublicProfilesOfAllUsers() // Liste aller Benutzer anzeigen
        ));
    }

    /**
     * Zeigt das Formular zur Erstellung eines neuen Benutzers
     */
    public function createUser()
    {
        $this->View->render('admin/create_user');
    }

    /**
     * Verarbeitet das Formular zur Benutzererstellung
     */
    public function createUserAction()
    {

        // Verwende das Registrierungsmodell, um einen neuen Benutzer hinzuzufügen
        $registration_successful = RegistrationModel::registerNewUser();

        if ($registration_successful) {
            // Erfolgsmeldung hinzufügen und zur Benutzererstellungsseite zurückkehren
            Session::add('feedback_positive', 'User successfully created.');
            Redirect::to('admin/createUser');
        } else {
            // Bei Fehlern ebenfalls zur Benutzererstellungsseite zurückkehren
            Redirect::to('admin/createUser');
        }
    }

    public function userManagement()
    {
        $users = UserModel::getAllUsersWithGroups();
        $groups = UserModel::getAllGroups();
        $this->View->render('admin/user_management', [
            'users' => $users,
            'groups' => $groups
        ]);
    }

    public function updateUserGroup()
    {
        $user_id = Request::post('user_id');
        $group_id = Request::post('group_id');

        if (UserModel::updateUserGroup($user_id, $group_id)) {
            Session::add('feedback_positive', 'User group updated successfully.');
        } else {
            Session::add('feedback_negative', 'Failed to update user group.');
        }
        Redirect::to('admin/userManagement');
    }
}
