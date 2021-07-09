<?php
function connect()
{
    $databaseHost = '127.0.0.1';//or localhost
    $databaseName = 'srms';
    $databaseUsername = 'root';
    $databasePassword = '';
    
    if($connection = new mysqli($databaseHost, $databaseUsername, $databasePassword, $databaseName)){
        return $connection;
    }else{
        echo "La Connexion au base de donnes est impossible";
    }   
}
?>
<?php
    function pdo_connect_mysql(){
        $DATABASE_HOST = 'localhost';
        $DATABASE_USER = 'root';
        $DATABASE_PASS = '';
        $DATABASE_NAME = 'srms';
        
        try{
            return new PDO('mysql:host='. $DATABASE_HOST .';dbname ='. $DATABASE_NAME .'; charset=utf8',$DATABASE_USER,$DATABASE_PASS);
        }catch(PDOException $exception){

            exit('Connection Failed');

        }
    }
    function template_header($title){
        echo <<<EOT
        <!DOCTYPE html>
        <html>
            <head>
                <meta charset = "utf8">
                <title>$title</title>
                <link rel="stylesheet" type="text/css" href="tables/datatables.min.css"/>
                <script src="tables/jquery.js"></script>
                <script src="tables/datatables.min.js"></script>
                <link href="style.css" rel="stylesheet" type="text/css">
                <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
                <style>
                body {
                    margin: 0;
                    font-family: Arial, Helvetica, sans-serif;
                    background-color: #ddd;
                }
                .topnav {
                    overflow: hidden;
                    background-color: #333;
                }

                .topnav a {
                    float: left;
                    color: #f2f2f2;
                    text-align: center;
                    padding: 14px 16px;
                    text-decoration: none;
                    font-size: 17px;
                }

                .create{
                    color: #f2f2f2;
                    background-color: #04AA6D;
                    text-align: center;
                    padding: 14px 16px;
                    text-decoration: none;
                    font-size: 17px;
                }
                .topnav a:hover {
                    background-color: #ddd;
                    color: black;
                }
                .create :hover {
                    background-color: #ddd;
                    color: black;
                }

                .topnav a.active {
                    background-color: #04AA6D;
                    color: white;
                }
                * {
                    box-sizing: border-box;
                }

                input[type=text], select, textarea {
                    width: 100%;
                    padding: 12px;
                    border: 1px solid #ccc;
                    border-radius: 4px;
                    resize: vertical;
                }
                input[type=number] {
                    width: 100%;
                    padding: 12px;
                    border: 1px solid #ccc;
                    border-radius: 4px;
                    resize: vertical;
                }
                input[type=password] {
                    width: 100%;
                    padding: 12px;
                    border: 1px solid #ccc;
                    border-radius: 4px;
                    resize: vertical;
                }

                label {
                    padding: 12px 12px 12px 0;
                    display: inline-block;
                }

                input[type=submit] {
                    background-color: #4CAF50;
                    color: white;
                    padding: 12px 20px;
                    border: none;
                    border-radius: 4px;
                    cursor: pointer;
                    float: right;
                }

                input[type=submit]:hover {
                    background-color: #45a049;
                }

                .container {
                    border-radius: 5px;
                    background-color: #f2f2f2;
                    padding: 20px;
                }

                .col-25 {
                    float: left;
                    width: 25%;
                    margin-top: 6px;
                }

                .col-75 {
                    float: left;
                    width: 75%;
                    margin-top: 6px;
                }

                    /* Clear floats after the columns */
                .row:after {
                    content: "";
                    display: table;
                    clear: both;
                }

                    /* Responsive layout - when the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other */
                @media screen and (max-width: 600px) {
                    .col-25, .col-75, input[type=submit] {
                        width: 100%;
                        margin-top: 0;
                    }
                }
                #res tbody tr td .actions {
                    text-decoration: none;
                }
                .footer {
                    position: fixed;
                    left: 0;
                    bottom: 0;
                    width: 100%;
                    background-color: black;
                    color: white;
                    text-align: center;
                }
            </style>

            </head>
            <body>
                <div class="topnav">
                    <a href="../home.php">Administration</a>
                    <a href="../Student">Gerer les Etudiants</a>
                    <a href="../Level">Gerer les Niveaux</a>
                    <a class="active" href="index.php">Gerer les Resultats</a>
                </div>
        EOT;
    }
    function template_footer(){
        echo <<<EOT
            </body>
        </html>
        EOT;
    }
?>