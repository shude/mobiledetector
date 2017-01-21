<?php
/**
 * MobileDetector
 *
 * @author Vladimir Tarkhanov <shu-de@kekx.ru>
 * @version 1.0.0
 */
namespace shude\mobiledetector;

use Yii;
use Detection\MobileDetect;
use yii\base\Component;


/**
 * Class MobileDetector
 *
 * This component detects user device from User-Agent string and replace
 * view paths if needed.
 *
 * Best choise to use the component is add it to a bootstrap section in configuration.
 *
 * @package shude\mobiledetector
 */
class MobileDetector extends Component {

    /**
     * @var bool whether to replace view paths
     */
    public  $rewritePaths = false;

    /**
     * @var string if $rewritePaths is true and user device detected as 'mobile' then
     * view path replaced on this value
     */
	public  $mobileViewPath  = '@app/views/mobile';

    /**
     * @var string if $rewritePaths is true and user device detected as 'desktop' then
     * view path replaced on this value
     */
    public  $desktopViewPath = '@app/views/desktop';

    /**
     * @var string if $rewritePaths is true and user device detected as 'tablet' then
     * view path replaced on this value
     */
    public  $tabletViewPath  = '@app/views/tablet';

    /**
     * @var string current device type
     */
    private $_device = 'desktop';

    /**
     * MobileDetect library instance
     * @var \Detection\MobileDetect
     */
    private $_md;

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
                Yii::$app->setLayoutPath($this->tabletViewPath.'/layouts');
            }
        }elseif ($this->_md->isMobile()){
            $this->_device = 'mobile';
            if($this->rewritePaths){
                Yii::$app->setViewPath($this->mobileViewPath);
                Yii::$app->setLayoutPath($this->mobileViewPath.'/layouts');
            }
        }else{
            if($this->rewritePaths){
                Yii::$app->setViewPath($this->desktopViewPath);
                Yii::$app->setLayoutPath($this->desktopViewPath.'/layouts');
            }
        }

        unset ($this->_md);
	}

    /**
     * Returns a string that represent a user device type.
     * @return string mobile|tablet|desktop
     */
    public function device(){
        return $this->_device;
    }

}
