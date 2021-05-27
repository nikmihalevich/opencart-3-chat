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
        $this->db->query("
		CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "chat_settings_nik` (
		  `id` INT(11) NOT NULL AUTO_INCREMENT,
		  `notification` INT(11) NOT NULL,
		  `position_left` INT(11) NOT NULL,
		  `position_left_unit` VARCHAR(10) NOT NULL,
		  `position_right` INT(11) NOT NULL,
		  `position_right_unit` VARCHAR(10) NOT NULL,
		  `position_top` INT(11) NOT NULL,
		  `position_top_unit` VARCHAR(10) NOT NULL,
		  `position_bottom` INT(11) NOT NULL,
		  `position_bottom_unit` VARCHAR(10) NOT NULL,
		  `initial_state` INT(11) NOT NULL,
		  `auto_open_time` INT(11) NOT NULL,
		  `auto_open_time_unit` VARCHAR(20) NOT NULL,
		  PRIMARY KEY (`id`)
		) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
		");
	}

	public function uninstall() {
		$this->db->query("DROP TABLE IF EXISTS `" . DB_PREFIX . "chat_operators_nik`");
		$this->db->query("DROP TABLE IF EXISTS `" . DB_PREFIX . "chat_settings_nik`");
	}

	public function saveChatSettings($data) {
        $this->db->query("DELETE FROM `" . DB_PREFIX . "chat_settings_nik`");

        $this->db->query("INSERT INTO `" . DB_PREFIX . "chat_settings_nik` SET notification = '" . (int)$data['notification'] . "', position_left = '" . (int)$data['position_left'] . "', position_left_unit = '" . $this->db->escape($data['position_left_unit']) . "', position_right = '" . (int)$data['position_right'] . "', position_right_unit = '" . $this->db->escape($data['position_right_unit']) . "', position_top = '" . (int)$data['position_top'] . "', position_top_unit = '" . $this->db->escape($data['position_top_unit']) . "', position_bottom = '" . (int)$data['position_bottom'] . "', position_bottom_unit = '" . $this->db->escape($data['position_bottom_unit']) . "', initial_state = '" . (int)$data['initial_state'] . "', auto_open_time = '" . (int)$data['auto_open_time'] . "', auto_open_time_unit = '" . $this->db->escape($data['auto_open_time_unit']) . "'");
    }

    public function getChatSettings() {
        $query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "chat_settings_nik`");

        return $query->row;
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
