<div class="container cake-form">
    <?php echo $this->Form->button('Add Contract', array("type" => "button","onclick"=>"location.href='add'","class"=>"btn btn-info")); ?>
    <table class="table table-striped table-bordered">
        <tr>
            <td width="15%" class="contract-listing-header">Name</td>
            <td width="15%" class="contract-listing-header">Address</td>
            <td width="20%" class="contract-listing-header">Email Id</td>
            <td width="20%" class="contract-listing-header">Phone</td>
            <td width="15%" class="contract-listing-header">Mobile</td>
        </tr>
        <?php foreach($result AS $key=>$value)
                {?>
                <tr class="success">
                    <td width="15%" class="fontcolor"><?php echo $this->Html->link($value['Contract']['name'],array('action'=>'add?option=edit&id='.$value['Contract']['id']));?></td>
                    <td width="15%" class="fontcolor"><?php echo $value['Contract']['address'];?></td>
                    <td width="20%" class="fontcolor"><?php echo $value['Contract']['email_id'];?></td>
                    <td width="20%" class="fontcolor"><?php echo $value['Contract']['phone_no'];?></td>
                    <td width="15%" class="fontcolor"><?php echo $value['Contract']['mobile_no'];?></td>
                </tr>
        <?php   } ?>
    </table>
</div>