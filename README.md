# 7Ue-ITL12 - Benutzerverwaltung / jQuery 

**Name**: Basty Asumadu - **Übungstag**: 06.12.2024 - **Klasse**: 3aAPC - **Gruppe**: A - **Lehrgang**: 2

## Geänderte und hinzugefügte Dateien

### 1. **Controller: `AdminController.php`**
   - **Pfad**: `application/controller/AdminController.php`
   - **Änderungen**:
     - Neue Methoden hinzugefügt:
       `userManagement()`: Lädt die Benutzer und Gruppen in die Benutzerverwaltungsansicht
       `updateUserGroup()`: Aktualisiert die Benutzerrolle

### 2. **Model: `UserModel.php`**
   - **Pfad**: `application/model/UserModel.php`
   - **Änderungen**:
     - Neue Methoden hinzugefügt:
       `getAllUsersWithGroups()`: Holt alle Benutzer mit ihren Gruppen aus der Datenbank
       `getAllGroups()`: Holt alle verfügbaren Benutzergruppen
       `updateUserGroup($user_id, $group_id)`: Aktualisiert die Gruppe eines Benutzers

### 3. **Ansichten:**
   - **Datei**: `user_management.php`
     - **Pfad**: `application/view/admin/user_management.php`
     - **Inhalt**: HTML- und PHP-Logik für die Benutzerverwaltung (Liste der Benutzer und Dropdown-Menüs für die Gruppen)
   - **Datei**: `user_list.php`
     - **Pfad**: `application/view/public/user_list.php`
     - **Inhalt**: HTML und JavaScript (jQuery DataTables) zur Anzeige der öffentlichen Benutzerliste

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

- [AdminController.php](/controller/AdminController.php)
- [UserModel.php](/model/UserModel.php)
- [user_management.php](/view/admin/user_management.php)
- [user_list.php](/admin/user_list.php)
- [header.php](view/_templates/header.php)
- [footer.php](view/_templates/footer.php)


So sieht es dann aus: (Angemeldet als Admin - Dann sehen wir den Button **User Managment** und die DataTables)
![image](https://github.com/user-attachments/assets/65b86d1a-e32e-4804-a14a-998aa3d06079)
![image](https://github.com/user-attachments/assets/c7ab1086-1107-4aa7-a861-9847ad569a35)

Wenn wir Angemeldet sind aber kein Admin würde es dann so aussehen: (Der **User Managment** Button wird nicht mehr angezeigt)
![image](https://github.com/user-attachments/assets/a856698a-1e2e-4d12-a9c7-8ca47b438e52)

Jetzt vergeben wir als Admin (demo) einen Gast (test123) die Rolle Admin
![image](https://github.com/user-attachments/assets/66e212ed-8526-4bf8-9d78-0094f69c9a28)

Wenn wir das als admin gemacht haben wird es uns da auch zeigen das es successfully gemacht wurde oder nicht
<img width="1552" alt="Bildschirmfoto 2024-12-12 um 11 10 45" src="https://github.com/user-attachments/assets/15e316f0-e1bd-4dd5-990e-a88a8f4978ba" />

Jetzt sieht der test123 den User **Managment button** auch
![image](https://github.com/user-attachments/assets/62a5838c-017e-414d-a10b-81eb01fc371c)







       
