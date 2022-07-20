<?php

    class Create{

        function database($connect){
            $sql = "CREATE DATABASE IF NOT EXISTS `clinic_management_system_db`";
            $query = $connect->query($sql) or die ($connect->error);
        }

        function patient_billing_table($connect){
            $sql = "CREATE TABLE IF NOT EXISTS `clinic_management_system_db`.`patient_billing_table` 
                    (
                        `Id` int(11) AUTO_INCREMENT PRIMARY KEY,
                        `Patient Id` int(11),
                        `Name` varchar(100),
                        `Doctor` varchar(100),
                        `Particular` text,
                        `Cost` varchar(100),
                        `Date` varchar(100),
                        FOREIGN KEY (`Patient Id`) REFERENCES `patient_table` (`Id`)
                    )";
            $query = $connect->query($sql) or die ($connect->error);
        }

        function tokenTable($connect){
            $sql = "CREATE TABLE IF NOT EXISTS `clinic_management_system_db`.`token_table` 
                    (
                        `Id` int(11) auto_increment PRIMARY KEY,
                        `Patient Id` int(11),
                        `Name` varchar(100),
                        `Doctor` int(11),
                        `Date` varchar(100)
                    )";
            $query = $connect->query($sql) or die ($connect->error);
        }

        function doctorsTable($connect){
            $sql = "CREATE TABLE IF NOT EXISTS `clinic_management_system_db`.`doctor_table` 
                    (
                        `Id` int(11) auto_increment PRIMARY KEY,
                        `Name` varchar(100),
                        `Mobile` varchar(100),
                        `Address` varchar(250),
                        `Password` varchar(100)
                    )auto_increment = 20000000";
            $query = $connect->query($sql) or die ($connect->error);
        }

        function secretaryTable($connect){
            $sql = "CREATE TABLE IF NOT EXISTS `clinic_management_system_db`.`secretary_table` 
                    (
                        `Id` int(11) auto_increment PRIMARY KEY,
                        `Name` varchar(100),
                        `Mobile` varchar(100),
                        `Address` varchar(250),
                        `Password` varchar(100)
                    )auto_increment = 30000000";
            $query = $connect->query($sql) or die ($connect->error);
        }

        function patientsTable($connect){
            $sql = "CREATE TABLE IF NOT EXISTS `clinic_management_system_db`.`patient_table` 
                    (
                        `Id` int(11) auto_increment PRIMARY KEY,
                        `Name` varchar(100),
                        `Mobile` varchar(100),
                        `Address` varchar(250)
                    )auto_increment = 10000000";
            $query = $connect->query($sql) or die ($connect->error);
        }

        function patientsHistoryTable($connect){
            $sql = "CREATE TABLE IF NOT EXISTS `clinic_management_system_db`.`patient_history_table` 
                    (
                        `Id` int(11) AUTO_INCREMENT PRIMARY KEY,
                        `Patient Id` int(11),
                        `Name` varchar(100),
                        `Disease` text,
                        `Medicine` text,
                        `Date` varchar(100),
                        `Doctor` varchar(100),
                        FOREIGN KEY (`Patient Id`) REFERENCES `patient_table` (`Id`)
                    )";
            $query = $connect->query($sql) or die ($connect->error);
        }

        function adminTable($connect){
            $sql = "CREATE TABLE IF NOT EXISTS `clinic_management_system_db`.`admin_table` 
                    (
                        `Id` int(11) auto_increment PRIMARY KEY,
                        `Password` varchar(100)
                    )";
            $query = $connect->query($sql) or die ($connect->error);

            $sql_Admin = "SELECT * FROM `clinic_management_system_db`.`admin_table`";
            $query_Admin = $connect->query($sql_Admin) or die ($connect->error);
            $total_Admin = $query_Admin->num_rows;

            if($total_Admin == 0){
                $sql = "INSERT INTO `clinic_management_system_db`.`admin_table`(`Id`, `Password`) 
                        VALUES ('1001','admin123')";
                $query = $connect->query($sql) or die ($connect->error);
            }
        }



    }

    $create = new Create();

?>