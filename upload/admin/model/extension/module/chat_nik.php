<?php
class ModelExtensionModuleChatNik extends Model {
	public function install() {
		$this->db->query("
		CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "chat_operators_nik` (
		  `operator_id` INT(11) NOT NULL AUTO_INCREMENT,
		  `user_id` INT(11) NOT NULL,
		  `online` INT(1) NOT NULL DEFAULT 0,
		  `date_added` datetime NOT NULL,
		  PRIMARY KEY (`operator_id`)
		) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
		");
	}

	public function uninstall() {
		$this->db->query("DROP TABLE IF EXISTS `" . DB_PREFIX . "chat_operators_nik`");
	}

    public function addOperator($user_id) {
        $this->db->query("INSERT INTO `" . DB_PREFIX . "chat_operators_nik` SET user_id = '" . (int)$user_id . "', date_added = NOW()");

        return $this->db->getLastId();
    }

    public function deleteOperator($user_id) {
        $this->db->query("DELETE FROM `" . DB_PREFIX . "chat_operators_nik` WHERE user_id = '" . (int)$user_id . "'");
    }

    public function getAllOperators() {
        $query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "chat_operators_nik`");

        $results = array();

        foreach ($query->rows as $row) {
            $query2 = $this->db->query("SELECT user_id, username, firstname, lastname, email, image FROM `" . DB_PREFIX . "user` WHERE user_id = '" . (int)$row['user_id'] ."'");
            $results[] = $query2->row;
        }

        return $results;
    }
}
