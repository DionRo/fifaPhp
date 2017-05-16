<?php
    /**
     * Created by PhpStorm.
<<<<<<< Updated upstream
     * User: Lex
     * Date: 5/8/17
     * Time: 22:29
     */

    if(isset($_POST['adjust'])) {
        require_once('../app/database.php');
        require_once('header.php');

        $user_id = $_POST['adjust'];

        // Getting and setting the user
        $query = 'SELECT * FROM tbl_users WHERE id = :id';
        $stmt = $db_conn->prepare($query);
        $stmt->execute(['id' => $user_id]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    } else {
        header('Location beheer.php');
        die;
    }
?>

    <h1 class="page-header">Edit user</h1>
    <form action="../app/adjust_user_manager.php" method="POST">
        <div class="form-group">
            <label for="name">Name:</label>
            <input class="form-control" type="text" id="name" name="name" value="<?php echo $user['name']; ?>">
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input class="form-control" type="password" id="password" name="password" placeholder="(unchanged)">
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input class="form-control" type="email" name="email" id="email" value="<?php echo $user['email']; ?>">
        </div>
        <div class="form-group">
            <label for="adminLevel">Admin Level:</label>
            <select class="form-control" name="adminLevel" id="adminLevel">
            <?php
                if ($user['adminLevel'] == 1) {
                    echo "
                        <option value=\"1\">1</option>
                        <option value=\"2\">2</option>
                    ";
                } else {
                    echo "
                        <option value=\"2\">2</option>
                        <option value=\"1\">1</option>
                    ";
                }
            ?>
            </select>
        </div>
        <div class="form-group">
            <input class="btn btn-primary" type="submit" value="Edit">
        </div>
        <div class="form-group">
            <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
        </div>
    </form>
