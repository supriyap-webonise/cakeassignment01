<?php
class EmployeesController extends AppController
{

    public function index()
    {
        $this->Employee->recursive = 0;
    }
    //import employee csv file to mysql table
    public function uploademployee()
    {
        if($this->request->is('post'))
        {
            if($this->request->data['Employee']['upload_file']['error']==4)
            {
                unset($this->request->data['Employee']['upload_file']);
            }
            else
            {
                $filename = basename($this->request->data['Employee']['upload_file']['name']);
                if(move_uploaded_file($this->data['Employee']['upload_file']['tmp_name'],WWW_ROOT . DS . 'uploads' . DS . $filename))
                {
                $this->request->data['Employee']['upload_file'] = $this->request->data['Employee']['upload_file']['name'];
                $this->Employee->importdata(WWW_ROOT . DS . 'uploads' . DS . $filename);
                }
                else
                {
                    $this->Session->setFlash(__("Unable to upload file..."));
                }

            }
        }
    }
}

