<div class="container cake-form">
    <?php echo $this->Form->button('Add Project', array("type" => "button","onclick"=>"location.href='add'","class"=>"btn btn-info"));
    echo $this->Form->input('contract_id', array(
        'options' =>$getcontracts,
        'empty' => '(choose one)',
        'onchange' => 'getprojects(this)',
        'div' =>array('align' =>'center')
    ));?>
    <table class="table table-striped table-bordered" id="project_list" style="display:none;">
        <tr>
            <td width="15%" class="contract-listing-header">Name</td>
            <td width="20%" class="contract-listing-header">Contact Person</td>
            <td width="20%" class="contract-listing-header">Start Date</td>
            <td width="20%" class="contract-listing-header">End Date</td>
        </tr>
    </table>