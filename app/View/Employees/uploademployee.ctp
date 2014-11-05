<div class="contracts cake-form">
    <?php echo $this->Form->create('Employee',array('enctype'=>'multipart/form-data')); ?>
    <fieldset>
        <legend>
            <?php echo __('Upload Employee Details'); ?>
        </legend>
        <?php
        echo $this->Form->input('upload_file',array('type'=>'file','class'=>'form-control'));
        ?>
    </fieldset>
    <?php
    echo $this->Form->submit('Save',array('class' => 'btn btn-primary',
                                           'after' => '&nbsp;&nbsp;&nbsp;&nbsp;'.$this->Form->button("Cancel",array("type"=>"button","class"=>"btn btn-danger","onclick"=>"location.href='contractlist'"))));
    echo $this->Form->end(); ?>
</div>

