  <div class="row">  <div id="infoMessage"><?php echo $message; ?></div>
                                            <?php echo $this->session->flashdata('dispMessage'); ?>
                                            <div class="col-md-6">

                                                <?php echo form_open_multipart(current_url(), 'class="form-inline pull-left"'); ?> 


                                                <div class="form-group">
                                                    <label for="excel">Select Excel Spreadsheet(.xls)</label>
                                                    <input type="file"  id="excel" name="excel">
                                                </div>
                                                <div class="form-group">
                                                    <input type="submit" class="btn btn-info waves-effect waves-light" name="upload" value="Bulk Upload"/>
                                                </div>
                                                <?php echo form_close(); ?>

                                            </div>

                                        </div>