<?php

namespace shude\mobiledetector;

use yii;
use Detection\MobileDetect;
use yii\base\Component;

/**
 * DeviceDetect
 *
 * @author Vladimir Tarkhanov <shu-de@kekx.ru>
 * @version 1.0.0
 */

class MobileDetector extends Component {

	private $_md;
	public  $rewritePaths = false;
	public  $mobileViewPath  = '@app\views\mobile';
    public  $desktopViewPath = '@app\views\desktop';
    public  $tabletViewPath  = '@app\views\tablet';

    private $_device = 'desktop';

	public function __construct($config = array()) {
		parent::__construct($config);
	}

	public function init() {

        parent::init();
        
        $this->_md = new MobileDetect();
        if($this->_md->isTablet()) {
            $this->_device = 'tablet';
            if($this->rewritePaths){
                Yii::$app->setViewPath($this->tabletViewPath);
            }
        }elseif ($this->_md->isMobile()){
            $this->_device = 'mobile';
            if($this->rewritePaths){
                Yii::$app->setViewPath($this->mobileViewPath);
            }
        }else{
            if($this->rewritePaths){
                Yii::$app->setViewPath($this->desktopViewPath);
            }
        }
	}

    /**
     * @return string mobile|tablet|desktop
     */
    public function device(){
        return $this->_device;
    }

}
