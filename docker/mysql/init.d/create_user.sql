CREATE DATABASE IF NOT EXISTS lotbot;
CREATE USER 'lotbot'@'%' identified by 'lotbot';
GRANT ALL ON lotbot.* TO 'lotbot'@'%' ;