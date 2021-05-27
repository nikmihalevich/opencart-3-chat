<?php
class ControllerExtensionModuleChatNik extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('extension/module/chat_nik');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('module_chat_nik', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true));
		}

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_extension'),
			'href' => $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('extension/module/chat_nik', 'user_token=' . $this->session->data['user_token'], true)
		);

		$data['action'] = $this->url->link('extension/module/chat_nik', 'user_token=' . $this->session->data['user_token'], true);

		$data['cancel'] = $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true);

		$data['mainLinkOperators'] = $this->url->link('extension/module/chat_nik/chatOperators', 'user_token=' . $this->session->data['user_token'], true);
		$data['mainLinkSettings'] = $this->url->link('extension/module/chat_nik/chatSettings', 'user_token=' . $this->session->data['user_token'], true);
		$data['mainLinkModuleChat'] = $this->url->link('extension/module/chat_nik/chatModule', 'user_token=' . $this->session->data['user_token'], true);

		if (isset($this->request->post['module_chat_nik_status'])) {
			$data['module_chat_nik_status'] = $this->request->post['module_chat_nik_status'];
		} else {
			$data['module_chat_nik_status'] = $this->config->get('module_chat_nik_status');
		}

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('extension/module/chat_nik', $data));
	}

	public function chatOperators() {
        $this->load->language('extension/module/chat_nik');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('extension/module/chat_nik');

        if (true) {
            if (isset($this->error['warning'])) {
                $data['error_warning'] = $this->error['warning'];
            } else {
                $data['error_warning'] = '';
            }

            if (($this->request->server['REQUEST_METHOD'] == 'POST')) {
                $this->model_extension_module_chat_nik->saveChatSettings($this->request->post);

                $this->session->data['success'] = $this->language->get('text_success');

                $this->response->redirect($this->url->link('extension/module/chat_nik/chatModule', 'user_token=' . $this->session->data['user_token'], true));
            }

            $data['breadcrumbs'] = array();

            $data['breadcrumbs'][] = array(
                'text' => $this->language->get('text_home'),
                'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'], true)
            );

            $data['breadcrumbs'][] = array(
                'text' => $this->language->get('text_extension'),
                'href' => $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true)
            );

            $data['breadcrumbs'][] = array(
                'text' => $this->language->get('heading_title'),
                'href' => $this->url->link('extension/module/chat_nik', 'user_token=' . $this->session->data['user_token'], true)
            );

            $data['actionLogin'] = $this->url->link('extension/module/chat_nik/chatModule', 'user_token=' . $this->session->data['user_token'], true);

            $data['cancel'] = $this->url->link('extension/module/chat_nik', 'user_token=' . $this->session->data['user_token'] . '&type=module', true);

            $operators = $this->model_extension_module_chat_nik->getAllOperators();

            $this->load->model('tool/image');

            foreach ($operators as $k => $operator) {
                if (!empty($operator)) {
                    if ($operator['image']) {
                        $operators[$k]['thumb'] = $this->model_tool_image->resize($operator['image'], 50, 50);
                    } else {
                        $operators[$k]['thumb'] = $this->model_tool_image->resize('no_image.png', 50, 50);
                    }
                }
            }

            $data['operators'] = $operators;

            $data['header'] = $this->load->controller('common/header');
            $data['column_left'] = $this->load->controller('common/column_left');
            $data['footer'] = $this->load->controller('common/footer');

            $this->response->setOutput($this->load->view('extension/module/chat_operator_login_nik', $data));
        } else {
            if (isset($this->error['warning'])) {
                $data['error_warning'] = $this->error['warning'];
            } else {
                $data['error_warning'] = '';
            }

            if (isset($this->request->get['horizontalTab'])) {
                $horizontalTab = $this->request->get['horizontalTab'];
            } else {
                $horizontalTab = 'operators';
            }

            $url = '';

            if (isset($this->request->get['horizontalTab'])) {
                $url .= '&horizontalTab=' . $horizontalTab;
            }

            if (($this->request->server['REQUEST_METHOD'] == 'POST')) {
                $this->model_extension_module_chat_nik->saveChatSettings($this->request->post);

                $this->session->data['success'] = $this->language->get('text_success');

                $this->response->redirect($this->url->link('extension/module/chat_nik/chatModule', 'user_token=' . $this->session->data['user_token'], true));
            }

            $data['breadcrumbs'] = array();

            $data['breadcrumbs'][] = array(
                'text' => $this->language->get('text_home'),
                'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'], true)
            );

            $data['breadcrumbs'][] = array(
                'text' => $this->language->get('text_extension'),
                'href' => $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true)
            );

            $data['breadcrumbs'][] = array(
                'text' => $this->language->get('heading_title'),
                'href' => $this->url->link('extension/module/chat_nik', 'user_token=' . $this->session->data['user_token'], true)
            );

            $data['actionMainSettings'] = $this->url->link('extension/module/chat_nik/chatModule', 'user_token=' . $this->session->data['user_token'], true);

            $data['cancel'] = $this->url->link('extension/module/chat_nik', 'user_token=' . $this->session->data['user_token'] . '&type=module', true);

            $data['operatorsTab'] = $this->url->link('extension/module/chat_nik/chatModule', 'user_token=' . $this->session->data['user_token'] . '&horizontalTab=operators', true);
            $data['clientsTab'] = $this->url->link('extension/module/chat_nik/chatModule', 'user_token=' . $this->session->data['user_token'] . '&horizontalTab=clients', true);

            $data['horizontalTab'] = $horizontalTab;

            $data['header'] = $this->load->controller('common/header');
            $data['column_left'] = $this->load->controller('common/column_left');
            $data['footer'] = $this->load->controller('common/footer');

            $this->response->setOutput($this->load->view('extension/module/chat_operators_nik', $data));
        }
    }

    public function chatModule() {
        $this->load->language('extension/module/chat_nik');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('setting/setting');
        $this->load->model('extension/module/chat_nik');

        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }

        if (isset($this->request->get['verticalTab'])) {
            $verticalTab = $this->request->get['verticalTab'];
        } else {
            $verticalTab = 'mainSettings';
        }

        $url = '';

        if (isset($this->request->get['verticalTab'])) {
            $url .= '&verticalTab=' . $verticalTab;
        }

        if (($this->request->server['REQUEST_METHOD'] == 'POST')) {
            $this->model_extension_module_chat_nik->saveChatSettings($this->request->post);

            $this->session->data['success'] = $this->language->get('text_success');

            $this->response->redirect($this->url->link('extension/module/chat_nik/chatModule', 'user_token=' . $this->session->data['user_token'], true));
        }

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'], true)
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_extension'),
            'href' => $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true)
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('extension/module/chat_nik', 'user_token=' . $this->session->data['user_token'], true)
        );

        $data['actionMainSettings'] = $this->url->link('extension/module/chat_nik/chatModule', 'user_token=' . $this->session->data['user_token'], true);

        $data['cancel'] = $this->url->link('extension/module/chat_nik', 'user_token=' . $this->session->data['user_token'] . '&type=module', true);

        $data['mainSettingsLink'] = $this->url->link('extension/module/chat_nik/chatModule', 'user_token=' . $this->session->data['user_token'] . '&verticalTab=mainSettings', true);
        $data['viewDesignChatLink'] = $this->url->link('extension/module/chat_nik/chatModule', 'user_token=' . $this->session->data['user_token'] . '&verticalTab=viewDesignChat', true);

        $data['verticalTab'] = $verticalTab;

        $data['chatSettings'] = $this->model_extension_module_chat_nik->getChatSettings();

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('extension/module/chat_module_nik', $data));
    }

	public function chatSettings() {
        $this->load->language('extension/module/chat_nik');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('setting/setting');
        $this->load->model('extension/module/chat_nik');

        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }

        if (isset($this->session->data['success'])) {
            $data['success'] = $this->session->data['success'];

            unset($this->session->data['success']);
        } else {
            $data['success'] = '';
        }

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'], true)
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_extension'),
            'href' => $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true)
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('extension/module/chat_nik', 'user_token=' . $this->session->data['user_token'], true)
        );

        $data['action'] = $this->url->link('extension/module/chat_nik', 'user_token=' . $this->session->data['user_token'], true);

        $data['cancel'] = $this->url->link('extension/module/chat_nik', 'user_token=' . $this->session->data['user_token'] . '&type=module', true);

        $data['addOperator'] = $this->url->link('extension/module/chat_nik/addOperator', 'user_token=' . $this->session->data['user_token'], true);
        $data['editOperator'] = $this->url->link('extension/module/chat_nik/editOperator', 'user_token=' . $this->session->data['user_token'], true);
        $data['deleteOperator'] = $this->url->link('extension/module/chat_nik/deleteOperator', 'user_token=' . $this->session->data['user_token'], true);

        $operators = $this->model_extension_module_chat_nik->getAllOperators();

        $this->load->model('tool/image');

        foreach ($operators as $k => $operator) {
            if (!empty($operator)) {
                if ($operator['image']) {
                    $operators[$k]['thumb'] = $this->model_tool_image->resize($operator['image'], 50, 50);
                } else {
                    $operators[$k]['thumb'] = $this->model_tool_image->resize('no_image.png', 50, 50);
                }
            }
        }

        $data['operators'] = $operators;

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('extension/module/chat_settings_nik', $data));
    }

    public function addOperator() {
        $this->load->language('user/user');
        $this->load->language('extension/module/chat_nik');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('user/user');
        $this->load->model('extension/module/chat_nik');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateOperatorForm()) {
            $user_id = $this->model_user_user->addUser($this->request->post);

            $this->model_extension_module_chat_nik->addOperator($user_id);

            $this->session->data['success'] = $this->language->get('text_success');

            $this->response->redirect($this->url->link('extension/module/chat_nik/chatSettings', 'user_token=' . $this->session->data['user_token'], true));
        }

        $this->getOperatorForm();
    }

    public function editOperator() {
        $this->load->language('user/user');
        $this->load->language('extension/module/chat_nik');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('user/user');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateOperatorForm()) {
            $this->model_user_user->editUser($this->request->get['user_id'], $this->request->post);

            $this->session->data['success'] = $this->language->get('text_success');

            $this->response->redirect($this->url->link('extension/module/chat_nik/chatSettings', 'user_token=' . $this->session->data['user_token'], true));
        }

        $this->getOperatorForm();
    }

    public function deleteOperator() {
        $this->load->language('extension/module/chat_nik');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('user/user');
        $this->load->model('extension/module/chat_nik');

        if (($this->request->server['REQUEST_METHOD'] == 'GET') && isset($this->request->get['user_id']) && $this->validateOperatorDelete()) {
            $this->model_user_user->deleteUser($this->request->get['user_id']);

            $this->model_extension_module_chat_nik->deleteOperator($this->request->get['user_id']);

            $this->session->data['success'] = $this->language->get('text_success');

            $this->response->redirect($this->url->link('extension/module/chat_nik/chatSettings', 'user_token=' . $this->session->data['user_token'], true));
        }

        $this->chatSettings();
    }

    protected function getOperatorForm() {
        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }

        if (isset($this->error['username'])) {
            $data['error_username'] = $this->error['username'];
        } else {
            $data['error_username'] = '';
        }

        if (isset($this->error['password'])) {
            $data['error_password'] = $this->error['password'];
        } else {
            $data['error_password'] = '';
        }

        if (isset($this->error['confirm'])) {
            $data['error_confirm'] = $this->error['confirm'];
        } else {
            $data['error_confirm'] = '';
        }

        if (isset($this->error['firstname'])) {
            $data['error_firstname'] = $this->error['firstname'];
        } else {
            $data['error_firstname'] = '';
        }

        if (isset($this->error['lastname'])) {
            $data['error_lastname'] = $this->error['lastname'];
        } else {
            $data['error_lastname'] = '';
        }

        if (isset($this->error['email'])) {
            $data['error_email'] = $this->error['email'];
        } else {
            $data['error_email'] = '';
        }

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'], true)
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('extension/module/chat_nik', 'user_token=' . $this->session->data['user_token'], true)
        );

        if (!isset($this->request->get['user_id'])) {
            $data['action'] = $this->url->link('extension/module/chat_nik/addOperator', 'user_token=' . $this->session->data['user_token'], true);
        } else {
            $data['action'] = $this->url->link('extension/module/chat_nik/editOperator', 'user_token=' . $this->session->data['user_token'] . '&user_id=' . $this->request->get['user_id'], true);
        }

        $data['cancel'] = $this->url->link('extension/module/chat_nik/chatSettings', 'user_token=' . $this->session->data['user_token'], true);

        if (isset($this->request->get['user_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
            $user_info = $this->model_user_user->getUser($this->request->get['user_id']);
        }

        if (isset($this->request->post['username'])) {
            $data['username'] = $this->request->post['username'];
        } elseif (!empty($user_info)) {
            $data['username'] = $user_info['username'];
        } else {
            $data['username'] = '';
        }

        if (isset($this->request->post['user_group_id'])) {
            $data['user_group_id'] = $this->request->post['user_group_id'];
        } elseif (!empty($user_info)) {
            $data['user_group_id'] = $user_info['user_group_id'];
        } else {
            $data['user_group_id'] = '';
        }

        $this->load->model('user/user_group');

        $data['user_groups'] = $this->model_user_user_group->getUserGroups();

        if (isset($this->request->post['password'])) {
            $data['password'] = $this->request->post['password'];
        } else {
            $data['password'] = '';
        }

        if (isset($this->request->post['confirm'])) {
            $data['confirm'] = $this->request->post['confirm'];
        } else {
            $data['confirm'] = '';
        }

        if (isset($this->request->post['firstname'])) {
            $data['firstname'] = $this->request->post['firstname'];
        } elseif (!empty($user_info)) {
            $data['firstname'] = $user_info['firstname'];
        } else {
            $data['firstname'] = '';
        }

        if (isset($this->request->post['lastname'])) {
            $data['lastname'] = $this->request->post['lastname'];
        } elseif (!empty($user_info)) {
            $data['lastname'] = $user_info['lastname'];
        } else {
            $data['lastname'] = '';
        }

        if (isset($this->request->post['email'])) {
            $data['email'] = $this->request->post['email'];
        } elseif (!empty($user_info)) {
            $data['email'] = $user_info['email'];
        } else {
            $data['email'] = '';
        }

        if (isset($this->request->post['image'])) {
            $data['image'] = $this->request->post['image'];
        } elseif (!empty($user_info)) {
            $data['image'] = $user_info['image'];
        } else {
            $data['image'] = '';
        }

        $this->load->model('tool/image');

        if (isset($this->request->post['image']) && is_file(DIR_IMAGE . $this->request->post['image'])) {
            $data['thumb'] = $this->model_tool_image->resize($this->request->post['image'], 100, 100);
        } elseif (!empty($user_info) && $user_info['image'] && is_file(DIR_IMAGE . $user_info['image'])) {
            $data['thumb'] = $this->model_tool_image->resize($user_info['image'], 100, 100);
        } else {
            $data['thumb'] = $this->model_tool_image->resize('no_image.png', 100, 100);
        }

        $data['placeholder'] = $this->model_tool_image->resize('no_image.png', 100, 100);

        if (isset($this->request->post['status'])) {
            $data['status'] = $this->request->post['status'];
        } elseif (!empty($user_info)) {
            $data['status'] = $user_info['status'];
        } else {
            $data['status'] = 0;
        }

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('extension/module/chat_operator_form_nik', $data));
    }

    public function install() {
        $this->load->model('extension/module/chat_nik');

        $this->model_extension_module_chat_nik->install();
    }

    public function uninstall() {
        if ($this->user->hasPermission('modify', 'extension/module/chat_nik')) {
            $this->load->model('extension/module/chat_nik');

            $this->model_extension_module_chat_nik->uninstall();
        }
    }

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'extension/module/chat_nik')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}

    protected function validateOperatorForm() {
        if (!$this->user->hasPermission('modify', 'user/user')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        if ((utf8_strlen($this->request->post['username']) < 3) || (utf8_strlen($this->request->post['username']) > 20)) {
            $this->error['username'] = $this->language->get('error_username');
        }

        $user_info = $this->model_user_user->getUserByUsername($this->request->post['username']);

        if (!isset($this->request->get['user_id'])) {
            if ($user_info) {
                $this->error['warning'] = $this->language->get('error_exists_username');
            }
        } else {
            if ($user_info && ($this->request->get['user_id'] != $user_info['user_id'])) {
                $this->error['warning'] = $this->language->get('error_exists_username');
            }
        }

        if ((utf8_strlen(trim($this->request->post['firstname'])) < 1) || (utf8_strlen(trim($this->request->post['firstname'])) > 32)) {
            $this->error['firstname'] = $this->language->get('error_firstname');
        }

        if ((utf8_strlen(trim($this->request->post['lastname'])) < 1) || (utf8_strlen(trim($this->request->post['lastname'])) > 32)) {
            $this->error['lastname'] = $this->language->get('error_lastname');
        }

        if ((utf8_strlen($this->request->post['email']) > 96) || !filter_var($this->request->post['email'], FILTER_VALIDATE_EMAIL)) {
            $this->error['email'] = $this->language->get('error_email');
        }

        $user_info = $this->model_user_user->getUserByEmail($this->request->post['email']);

        if (!isset($this->request->get['user_id'])) {
            if ($user_info) {
                $this->error['warning'] = $this->language->get('error_exists_email');
            }
        } else {
            if ($user_info && ($this->request->get['user_id'] != $user_info['user_id'])) {
                $this->error['warning'] = $this->language->get('error_exists_email');
            }
        }

        if ($this->request->post['password'] || (!isset($this->request->get['user_id']))) {
            if ((utf8_strlen(html_entity_decode($this->request->post['password'], ENT_QUOTES, 'UTF-8')) < 4) || (utf8_strlen(html_entity_decode($this->request->post['password'], ENT_QUOTES, 'UTF-8')) > 40)) {
                $this->error['password'] = $this->language->get('error_password');
            }
        }

        return !$this->error;
    }

    protected function validateOperatorDelete() {
        if (!$this->user->hasPermission('modify', 'user/user')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        if ($this->user->getId() == $this->request->get['user_id']) {
            $this->error['warning'] = $this->language->get('error_account');
        }

        return !$this->error;
    }
}