<?php

/**
 * Description of SetLnguage
 *
 * @author user
 */

namespace common\components;

use Yii;
use yii\base\Component;
use yii\web\Cookie;

class SetLanguage extends Component {

    public function init() {
        $url = Yii::$app->request->url;
        if (strpos($url, '/ar') !== false) {
           $lang = 'ar';
        }else{
            $lang = 'en';
        }
        $language = $this->Language($lang);
        Yii::$app->session['language'] = $language;

        parent::init();
    }

    /*
     * check cookie set or not, if not set default language is Ebglish
     */

    public static function Language($lang) {
        if($lang != ''){
            setcookie('language', '', time() - 999999, '/', '');
            $cookie = new Cookie([
            'name' => 'language',
            'value' => $lang,
            'expire' => time() + 86400 * 1,
        ]);

        Yii::$app->getResponse()->getCookies()->add($cookie);
        }else{
            $lang = 'en';
              setcookie('language', '', time() - 999999, '/', '');
            $cookie = new Cookie([
            'name' => 'language',
            'value' => $lang,
            'expire' => time() + 86400 * 1,
        ]);
        Yii::$app->getResponse()->getCookies()->add($cookie);
        }

        Yii::$app->session['language'] = $lang;
        return $lang;
    }

    /*
     * set cookie
     */

    public static function SetLanguage($langauge = null) {

        setcookie('language', '', time() - 999999, '/', '');
        $cookie = new Cookie([
            'name' => 'language',
            'value' => $langauge,
            'expire' => time() + 86400 * 1,
        ]);

        Yii::$app->getResponse()->getCookies()->add($cookie);
    }

}
