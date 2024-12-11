# 7Ue-ITL12 - Benutzerverwaltung / jQuery 

**Name**: Basty Asumadu - **Übungstag**: 06.12.2024 - **Klasse**: 3aAPC - **Gruppe**: A - **Lehrgang**: 2
- [AdminController.php](/controller/AdminController.php)
- [UserModel.php](/model/UserModel.php)
- [user_management.php](/view/admin/user_management.php)
- [user_list.php](/admin/user_list.php)
- [header.php](view/_templates/header.php)
- [footer.php](view/_templates/footer.php)


## Geänderte und hinzugefügte Dateien

### 1. **Controller: `AdminController.php`**
   - **Pfad**: `application/controller/AdminController.php`
   - **Änderungen**:
     - Neue Methoden hinzugefügt:
       - `userManagement()`: Lädt die Benutzer und Gruppen in die Benutzerverwaltungsansicht.
       - `updateUserGroup()`: Aktualisiert die Benutzerrolle.

### 2. **Model: `UserModel.php`**
   - **Pfad**: `application/model/UserModel.php`
   - **Änderungen**:
     - Neue Methoden hinzugefügt:
       - `getAllUsersWithGroups()`: Holt alle Benutzer mit ihren Gruppen aus der Datenbank.
       - `getAllGroups()`: Holt alle verfügbaren Benutzergruppen.
       - `updateUserGroup($user_id, $group_id)`: Aktualisiert die Gruppe eines Benutzers.

### 3. **Ansichten:**
   - **Datei**: `user_management.php`
     - **Pfad**: `application/view/admin/user_management.php`
     - **Inhalt**: HTML- und PHP-Logik für die Benutzerverwaltung (Liste der Benutzer und Dropdown-Menüs für die Gruppen).
   - **Datei**: `user_list.php`
     - **Pfad**: `application/view/public/user_list.php`
     - **Inhalt**: HTML und JavaScript (jQuery DataTables) zur Anzeige der öffentlichen Benutzerliste.

### 4. **Frontend-Ressourcen:**
   - **Datei**: `header.php`
     - **Pfad**: `application/view/_templates/header.php`
     - **Änderungen**:
       - Hinzugefügt:
         ```html
         <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
         <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
         <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
         ```
