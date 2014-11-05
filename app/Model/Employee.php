<?php class Employee extends AppModel
{
    //import csv file data after uploading
    public function importdata($filename)
    {
        if (file_exists($filename))
        {
            $this->data = file_get_contents($filename);
            if ($this->data != '')
            {
                $lines = explode("\n", $this->data);
                if (is_array($lines) && count($lines) > 0)
                {
                    $insert_string = '';
                    $data_array = array();
                    if ($this->field_names == true)
                        $start_ind = 0;
                    else
                        $start_ind = 1;

                    for($i=$start_ind;$i<count($lines);$i++)
                    {
                        if ($lines[$i] != '')
                        {
                            $data_array = explode(',', $lines[$i]);
                            if (is_array($data_array) && count($data_array) > 0)
                            {
                                $t_str = '';
                                foreach($data_array as $data_row)
                                {
                                    $t_str .= "'".$data_row."',";
                                }
                            }
                            $insert_string .= '('.trim($t_str,",").'),';
                        }
                    }
                    $insert_string = trim($insert_string,",");
                    if ($insert_string != '')
                    {
                        $insert_query = "INSERT INTO employees VALUES $insert_string";
                        $ins = $this->query($insert_query);
                        //if ($ins)
                            $this->Session->setFlash(__("Data Inserted Successfully..."));
                        //else
                        //  $this->Session->setFlash(__("Problem While Inserting Data..."));
                    }
                }
            }
            else
            {
                $this->Session->setFlash(__("Error: No Data In CSV file"));
            }

        }
        else
        {
            $this->Session->setFlash(__("Error: Cannot open file(".$this->filename.")"));
        }
    }

}
