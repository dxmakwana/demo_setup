<?php 
    $cnt=$ctdc;
?>
<div class="row align-items-end"  id="task_duration_wrapper<?php echo $cnt;?>">
    <div class="col-md-3">
        <div class="form-group">

            <label for="task_duration_date<?php echo $cnt;?>">Datum</label>

            <input type="date" class="form-control" name="task_duration_date[]" id="task_duration_date<?php echo $cnt;?>" placeholder="Date" value="<?php if(isset($_REQUEST['id']) && isset($fetch_duration['date'])){ echo $fetch_duration['date']; } ?>">

        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">

            <label for="task_duration_start_time<?php echo $cnt;?>">Start Time</label>

            <input type="time" class="form-control" name="task_duration_start_time[]" id="task_duration_start_time<?php echo $cnt;?>" placeholder="Start Time" value="<?php if(isset($_REQUEST['id']) && isset($fetch_duration['start_time'])){ echo $fetch_duration['start_time']; } ?>">

        </div>
    </div>
    <div class="col-md-2">
        <label for="task_duration_end_time<?php echo $cnt;?>">End Time</label>
        <div class="form-group">
            <input type="time" class="form-control" name="task_duration_end_time[]" id="task_duration_end_time<?php echo $cnt;?>" placeholder="End Time" value="<?php if(isset($_REQUEST['id']) && isset($fetch_duration['end_time'])){ echo $fetch_duration['end_time']; } ?>">
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="task_duration_duration_description<?php echo $cnt;?>"> Description</label>
            <input type="text" class="form-control" name="task_duration_duration_description[]" id="task_duration_duration_description<?php echo $cnt;?>" placeholder="Description" value="<?php if(isset($_REQUEST['id']) && isset($fetch_duration['duration_description'])){ echo $fetch_duration['duration_description']; } ?>">
        </div>
    </div>
    <div class="col-md-2">
        <div class="btn-group">
            <button type="button" data-val="<?php echo $cnt;?>" onclick="AddMoreTaskTimeEntries(this);" style="background: #294351;" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i></button>
            <?php if($cnt>1){ ?>
            <button type="button" data-val="<?php echo $cnt;?>" onclick="RemoveTaskTimeEntries(this);" style="background: #294351;" class="btn btn-sm btn-primary"><i class="fas fa-trash"></i></button>
            <?php }?>
        </div>    
    </div>
</div>