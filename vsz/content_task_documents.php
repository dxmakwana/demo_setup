<?php $task_id = isset($_REQUEST['id']) ? $_REQUEST['id'] : 0; ?>

            
                <div class="card-header1">
                    <h3 class="card-title">Attach Files</h3>
                </div>
                <div class="card-body">
                    <!-- <div class="add_title_box">Attach Files</div> -->

                    <!-- Add Document Form -->
                    <div>
                            <div class="col-md-12" style="<?php if(isset($is_view_only) && $is_view_only==1){echo 'display:none;';}?>">
                                <form id="addDocumentForm" class="row g-3 validate-forms" data-err_msg_ele="help" method="post" action="process/action_task_document.php"  enctype="multipart/form-data">
                                    <input type="hidden" name="task_id" value="<?php echo $task_id; ?>">
                                
                                    <div class="col-md-12">
                                        <label for="document" class="form-label">Upload document</label>
                                        <input type="file" class="form-control" required id="document" data-is_validate="1" name="document[]" multiple="multiple" accept=".pdf, .doc, .docx, .txt">
                                        <span class="help text-danger" id="msg2"></span>
                                    </div>

                                    <div class="col-12 text-center mt-3">
                                        <button class="save_btn" type="submit" id="add_document_submit">Save document</button>
                                    </div>
                                </form>
                            </div>
                                        <!-- List Documents Table -->
                            <div class="row pad_12">
                                <div class="col-md-12">
                                    <!-- Include your list documents table code here -->
                                        <div class="row col-md-12">
                                        <?php
                                            // Fetch and display documents associated with the damage case
                                            
                                            $task_documents_query = "SELECT * FROM vsz_task_document WHERE task_id = '$task_id'";
                                            $result_documents = mysqli_query($conn, $task_documents_query); 
                                            $upload_path='uploads/';

                                            while ($document = mysqli_fetch_assoc($result_documents)) 
                                            {
                                                $document_name=$document['document'];
                                                $document_date=date('m/d/Y',strtotime($document['created_at']));

                                                echo '<div class="col-md-4"><a download target="_blank" href="'.$upload_path.$document_name.'">' . $document_name . '</a> <span style="padding-left:10px;">'.$document_date.'</span></div>';
                                                
                                            }
                                        ?>
                                        
                                </div>
                            </div>
                    </div><!-- End Add Document Form Content -->

                
                </div>
            
