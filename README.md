<div align="center">

[**Requirements**](#requirements) • [**Installation process**](#installation-process) • [**Documentation**](#documentation)

</div>

# Setup

## Requirements
* composer 2.1.8
* a server (like MAMP)
* a Virtual Host
* symfony 5.3.*
* a SQL database

## Installation process

Clone the project in your choice folder where symfony is installed:

`git clone git@github.com:juliaDebray/online-loan.git`

Create a vhost for the project.

Then run:
```bash
cd online-loan
composer install
```

At the line 31 in the `.env` file, enter your identifiant, password,
port and name of your database.

Then:
```bash
php bin/console doctrine:database:create 
php bin/console make:migration
php bin/console doctrine:migrations:migrate
chmod 777 public/uploads/booksCover
```

There are 3 user accounts already created in your database when you ran the above script.
you can use them with this credentials:

| Accout   | Login                | Password |
|----------|----------------------|----------|
| Admin    | admin@admin.fr       | admin    |
| Employee | employee@employee.fr | employee |
| Admin    | customer@customer.fr | customer |

you can change their password as you please running:
```bash
php bin/console security:hash-password
[0] app\Entity\Users
[enter your password]
```

Then, copy your new password.
If you have not yet run the migration, you can edit the password with your new, directly
in the migration file.
Otherwise, add it in your database.

You can now work on the application !

## Documentation

[Trello](https://trello.com/invite/b/D2G7eZkN/95b44e658f9155dbdbeaacccf9861856/cr%C3%A9er-lapplication)

[Deployed Application](https://online-loan.herokuapp.com/)
    