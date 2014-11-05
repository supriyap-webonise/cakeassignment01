<link href="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.2.2/css/bootstrap-combined.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" media="screen" href="http://tarruda.github.com/bootstrap-datetimepicker/assets/css/bootstrap-datetimepicker.min.css">
<script type="text/javascript" src="http://tarruda.github.com/bootstrap-datetimepicker/assets/js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript" src="http://tarruda.github.com/bootstrap-datetimepicker/assets/js/bootstrap-datetimepicker.pt-BR.js"></script>
<div class="projects cake-form">
    <?php echo $this->Form->create('Project',array('enctype'=>'multipart/form-data')); ?>
    <fieldset>
        <legend>
            <?php echo __('Project Details'); ?>
        </legend>
        <?php
        if(isset($getdata['Project']['id'])) { $id= $getdata['Project']['id']; $style='display:block;';} else { $id =''; $style='display:none;';}
        if(isset($getdata['Project']['name'])) $name= $getdata['Project']['name']; else $name= '';
        if(isset($getdata['Project']['contract_id'])) $contract_id= $getdata['Project']['contract_id']; else $contract_id= '';
        if(isset($getdata['Project']['contact_person'])) $contact_person= $getdata['Project']['contact_person']; else $contact_person= '';
        if(isset($getdata['Project']['start_date'])) $start_date= $getdata['Project']['start_date'];else $start_date = '';
        if(isset($getdata['Project']['end_date'])) $end_date= $getdata['Project']['end_date'];else $end_date='';
        if(isset($getdata['Project']['resource'])) $resource= $getdata['Project']['resource'];else $resource = '';
        echo $this->Form->input('id',array('value'=>$id,'type'=>'hidden'));
        echo $this->Form->input('contract_id', array(
            'options' =>$getcontracts,
            'selected' =>$contract_id

        ));
        echo $this->Form->input('name',array('class'=>'form-control','value'=>$name));
        echo $this->Form->input('contact_person',array('class'=>'form-control','value'=>$contact_person));?>

        <label>Start Date</label>
        <div id="datetimepicker" class="input-append date">
            <input type="text" name="data[Project][start_date]" id="Projectstart_date"  value="<?php echo $start_date;?>"  class="form-control">
              <span class="add-on add-on1">
                <i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
              </span>
            </input>
        </div>
        <label>End Date</label>
        <div id="datetimepicker1" class="input-append date">
            <input type="text" name="data[Project][end_date]" id="Projectend_date"  value="<?php echo $end_date;?>" class="form-control">
              <span class="add-on add-on1">
                <i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
              </span>
            </input>
        </div>
        <?php
        echo "Resource<br/>";
        ?>
        <select id="project_emp" name="project_emp" onchange="getprojectemp()">
            <option value="">Choose</option>
            <?php foreach($getemployees AS $key => $value)
                    { ?>
                        <option value="<?php echo $value['employees']['id']?>" work="<?php echo $value['employees']['work_load']?>"><?php echo $value['employees']['name'];?></option>
            <?php   } ?>
        </select>

        <table class="table table-striped table-bordered" width="60%" style="<?php echo $style;?>" id="tbl_employee">
            <tr>
                <td width="40%">Name</td>
                <td width="10%">Total Work Load (%)</td>
                <td width="10%">Allocate(%)</td>
            </tr>
            <?php if(isset($this->request->query['option']) && $this->request->query['option']=='edit')
                    {
                        foreach($projectemployee AS $employeekey=>$employeevalue)
                        {?>
                            <tr>
                                <td><?php echo $employeevalue['Employee']['name'];?></td>
                                <td><?php echo $employeevalue['Employee']['work_load'];?></td>
                                <td><?php echo $employeevalue['project_employee']['allocate'];?></td>
                            </tr>
            <?php       }
                    }?>
        </table>
    </fieldset>
    <?php
    echo $this->Form->submit('Save',array('class' => 'btn btn-primary',
                                          'after'=>  '&nbsp;&nbsp;&nbsp;&nbsp;'.$this->Form->button("Cancel",array("type"=>"button","class"=>"btn btn-danger","onclick"=>"location.href='projectlist'"))));
    echo $this->Form->end(); ?>
</div>
<script type="text/javascript">
    $('#datetimepicker').datetimepicker({
        format: 'yyyy-MM-dd hh:mm:ss',
    });
    $('#datetimepicker1').datetimepicker({
        format: 'yyyy-MM-dd hh:mm:ss',
    });
</script>