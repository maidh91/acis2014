<?php
return array (
    'permissionRules' => array(
                        'see_lang' => 'See all langs',
                        
                    ),
     'synLang' => array(
                    'linkModels' =>  array('modules/content/models/ContentCategory.php',
                    						'modules/content/models/Content.php',
                    						'modules/recruitment/models/Recruitment.php',
                    						'modules/recruitment/models/RecruitmentCategory.php',
                    						'modules/download/models/Download.php',
                    						'modules/download/models/DownloadFolder.php',
                    						'modules/mail/models/Mail.php'
                    					),
                    'nameModels' => array('Content','ContentCategory','Recruitment','RecruitmentCategory','Download','DownloadFolder',
                    					'Mail'
                    						),
             		'function' => 'synLang'
                    ),
);
