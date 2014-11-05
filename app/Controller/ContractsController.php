<?php
class ContractsController extends AppController
{

    public function index()
    {
        $this->Contract->recursive = 0;
    }
    //get contract list
    public function contractlist()
    {
        $result1 = Cache::read('Allcategory', '_cake_model_');
        $result2 = Cache::read('Allcategory', '_APC_');
        $result3 = Cache::read('Allcategory', '_Memcache_');
        //used ternary operator to check whether any of the above cache is saved
        $result = (!$result1?(!$result2?$result3:$result2):$result1);
        if (!$result || (isset($this->request->params['named']['cache']) && $this->request->params['named']['cache']=='true'))
        {
                $result = $this->Contract->find('all');
                Cache::write('Allcategory', $result, '_cake_model_');
                Cache::write('Allcategory', $result, '_APC_');
                Cache::write('Allcategory', $result, '_Memcache_');
        }
        $this->set('result',$result);
    }

    //For add and edit of contract record
    public function add()
    {
       if(isset($this->request->query['option']) && $this->request->query['option']=='edit')
       {
           $getdata = $this->Contract->find('first',array('conditions'=>'id='.$this->request->query['id']));
           $this->set('getdata',$getdata);
       }
        if($this->request->is('post'))
        {
            $this->Contract->create();
            if($this->Contract->Save($this->request->data))
            {
                return $this->redirect(array('action'=>'contractlist','cache'=>'true'));
            }
        }
    }
}
