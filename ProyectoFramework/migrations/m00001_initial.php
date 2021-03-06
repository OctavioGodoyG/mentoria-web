<?php

class m00001_initial{
    public function up(){
        $db = app\core\Application::$app->db ;

        // echo "Applying migration";
        $sql = "CREATE TABLE `users` (
            `id` int NOT NULL,
            `full_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
            `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
            `user_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
            `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";
        $db->pdo->exec($sql);

        $sql = "ALTER TABLE `users`
            ADD PRIMARY KEY (`id`);";
        $db->pdo->exec($sql);

        $sql = "ALTER TABLE `users`
            MODIFY `id` int NOT NULL AUTO_INCREMENT;";
        $db->pdo->exec($sql);

        if(!empty($migrations)){

        }

    }

    public function down(){
        echo "Reversing migration";
    }
}