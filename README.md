#Yii2 device detection

This component detects user device from User-Agent string and replace
view paths if needed.

##Usage
Best choise to use the component is add it to a bootstrap section in configuration.
````php
[   
    'bootstrap' => ['mobile_detect'],
    'components' => [
       'mobile_detect' => [
          'class' => 'shude\mobiledetector\MobileDetector'
       ]
    ]
]
````
Then in app you can check device type like this:
````php
Yii::$app->mobile_detect->device();
````

###View paths replacement
If you want to separate views or layouts with different device types,
just add paths in configuration and set `$rewritePaths` to true.
````php
[
    'components' => [
       'mobile_detect' => [
          'class' => 'shude\mobiledetector\MobileDetector',
          'rewritePaths' => true,
          'mobileViewPath'  => '@app/views/mobile',   //Default value
          'tabletViewPath'  => '@app/views/tablet',   //Default value
          'desktopViewPath' => '@app/views/desktop',  //Default value
       ]
    ]
]
````