<?php
class test_IndexController extends Nine_Controller_Action
{
	public function indexAction()
	{
		/**
		 * Display tempalte
		 */
	    $this->view->headTitle('Test module');

	    $str = 'restaurant/This is title///111----221412';
	    
	    echo $this->makeURLSafeString($str);die;
	}
	
	public function fixUserInfoAction()
	{
        include 'libs/Shared/models/User.php';
        include 'libs/Shared/models/Store.php';
        include 'libs/Shared/models/StoreClerk.php';
        
        $objUser = new Models_User();
        $objStore = new Models_Store();
        $objStoreClerk = new Models_StoreClerk();
        
        /**
         * Fix owner
         */
        
        /**
         * All location manager
         */
        $allUsers = $objUser->getByColumns(array('group_id=?' => 4));
        
        foreach ($allUsers as $user)
        {
            $store = $objStore->getByColumns(array('user_id=?' => $user['user_id']))->toArray();
            $store = reset($store);
            
            if (null != @$store['company_id']) {
                $user->company_id = $store['company_id'];
                $user->save();
            }
        }
        
        /**
         * Fix clerk
         */
        $allUsers = $objUser->getByColumns(array('group_id=?' => 5));
        foreach ($allUsers as $user)
        {
            $storeId = $objStoreClerk->getByColumns(array('user_id =?' => $user['user_id']))->toArray();
            $storeId = reset($storeId);
            $storeId = @$storeId['store_id'];
            if (null == $storeId) {
                continue;
            }
            
            $store = $objStore->find($storeId)->toArray();
            $store = reset($store);
            
            if (null != @$store['company_id']) {
                $user->company_id = $store['company_id'];
                $user->store_id = $storeId;
                $user->save();
            }
        }
        
        echo "Finished";die;
	}
	
	public function testAction() 
	{
        var_dump(ini_set('magic_quotes_gpc', false));die;
	}
	

}