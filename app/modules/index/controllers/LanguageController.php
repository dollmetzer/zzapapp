<?php
/**
 * E x a m p l e   a p p l i c a t i o n   s c a f f o l d
 * ========================================================
 * For the zzaplib 3 mini framework
 *
 * @author Dirk Ollmetzer (dirk.ollmetzer@ollmetzer.com)
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL 3.0
 * @copyright 2006-2022 Dirk Ollmetzer (dirk.ollmetzer@ollmetzer.com)
 */

namespace Application\modules\index\controllers;

use dollmetzer\zzaplib\controller\WebController;

class LanguageController extends WebController
{
    public function setAction()
    {
        $params = $this->request->getParams();
        if (sizeof($params) > 0) {
            $languages = $this->config->get('languages');
            if (in_array($params[0], $languages)) {
                $this->session->set('userLanguage', $params[0]);
            }
        }
        $this->response->redirect($this->router->buildURL(''));

        die('language::set');
    }
}
