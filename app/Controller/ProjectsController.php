<?php
class ProjectsController extends AppController
{

    public function index()
    {
        $this->Project->recursive = 0;
    }
    //get category list
    public function projectlist()
    {
        $getcontracts = $this->Project->getcontracts();
        $this->set('getcontracts',$getcontracts);
    }
    //get Project list
    public function categoryprojectlist()
    {
        $this->autoRender = false;
        if($this->request->data['val']!='')
        {
            $result = $this->Project->projectlist($this->request->data['val']);
            $tr='';
            foreach($result AS $key=>$value)
            {
            $tr .='<tr class="success">
                <td width="15%" class="fontcolor"><a href="add?option=edit&id='.$value["Project"]["id"].'">'.$value["Project"]["name"].'</a></td>
                <td width="15%" class="fontcolor">'.$value['Project']['contact_person'].'</td>
                <td width="20%" class="fontcolor">'.$value['Project']['start_date'].'</td>
                <td width="20%" class="fontcolor">'.$value['Project']['end_date'].'</td>
            </tr>';
              }
            return $tr;
        }
    }

    //For add and edit of project record
    public function add()
    {
       $getcontracts = $this->Project->getcontracts();
       $this->set('getcontracts',$getcontracts);
        $getemployees = $this->Project->getemployees();
        $this->set('getemployees',$getemployees);

       if(isset($this->request->query['option']) && $this->request->query['option']=='edit')
       {
          $getdata = $this->Project->find('first',array('fields'=>array('Project.id','Project.name','Project.contact_person','Project.start_date','Project.end_date','Project.resource','Project.contract_id'),
              'conditions'=>'Project.id='.$this->request->query['id']));
           $this->set('getdata',$getdata);

           $this->loadModel('Employee');

           $projectemployee = $this->Employee->query("SELECT `Employee`.`id` , `Employee`.`name` , `Employee`.`work_load`,project_employee.allocate
                                                      FROM `cakeassignment`.`employees` AS `Employee`
                                                      JOIN project_employee ON project_employee.employeeid=Employee.id AND project_employee.projectid=".$this->request->query['id']);
           $this->set('projectemployee',$projectemployee);
       }
        if($this->request->is('post'))
        {
            $this->Project->create();
            $mainstr = '';
            $str ='';
            if($projectid = $this->Project->Save($this->request->data))
            {
                if(is_array($this->request->data['empid']))
                {
                    foreach($this->request->data['empid'] AS $key => $value)
                    {
                        $str .= '("",'.$projectid['Project']['id'].','.$value.','.$this->request->data['employeeid_'.$value].'),';
                        $this->Project->query("UPDATE employees SET work_load= work_load + ".$this->request->data['employeeid_'.$value]." where id = ".$value);
                    }
                }
                $mainstr = substr($str, 0, -1);
                $this->Project->query("INSERT INTO project_employee values ".$mainstr);
                return $this->redirect(array('action'=>'projectlist'));
            }
        }
    }
}
