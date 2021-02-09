<?php
class Pripojeni {

    public static function pripojeniDatabaze()
    {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "fanpage";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Připojení selhalo: " . $conn->connect_error);
        }
        $conn->set_charset("utf8");
        return $conn;
    }

    public static function registrace($jmeno, $prijmeni, $email, $heslo, $prava)
    {
                $conn = Pripojeni::pripojeniDatabaze();
                if ($stmt = $conn->query("SELECT * FROM uzivatele WHERE email='$email'")) {
                    $num =  $stmt->num_rows;
                    echo"$num";
                    if($num >= 1){
                        return "Email již existuje";
                        }
                    }
                $result = $conn->prepare("INSERT INTO uzivatele (jmeno, prijmeni, email, heslo, prava)
                                                VALUES (?,?,?,?,?)");
                if ($result) {
                $hash_heslo = password_hash($heslo, PASSWORD_DEFAULT);
                $result->bind_param("sssss", $jmeno, $prijmeni, $email, $hash_heslo, $prava);

                } else echo "error";
                if ($result->execute() == true) {
                    return "Byl/a jste úspěšně zaregistrován/a! <a href='prihlaseni.php'>Klikněte zde pro přihlášení</a>";
                } else {
                    return "Nastal problém při registraci... Zkuste to prosím znovu!";
                }
    }


    public static function prihlaseni($email,$heslo) {
        $conn = Pripojeni::pripojeniDatabaze();
        if ($stmt = $conn->prepare("SELECT * FROM uzivatele WHERE email =? limit 1")) {
            $stmt->bind_param("s",$email);
            $stmt->execute();
            $vysledek = $stmt->get_result();
            $polozka = $vysledek->fetch_assoc();

            if ($polozka != null && password_verify($heslo, $polozka['heslo'])) {
            $_SESSION['usr_id'] = $polozka['id'];
            $_SESSION['usr_jmeno'] = $polozka['jmeno'];
            $_SESSION['usr_prijmeni'] = $polozka['prijmeni'];
            $_SESSION['usr_heslo'] = $polozka['heslo'];
            $_SESSION['prava'] = $polozka['prava'];
            header("Location: ucet.php");
            return "Úspěch!";
            } else {
               return "Uživatel s takovými údaji nebyl nalezen!";
            }
        } else {
            return "Uživatel nenalezen!";
        }
    }

static function alert($zprava) {
    echo "<script type='text/javascript'>alert('$zprava');</script>";
    }
}
