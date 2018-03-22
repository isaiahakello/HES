           <div class="form-group">
                                                                <label class="control-label col-md-3">Outcome
                                                                    <span class="required" aria-required="true"> * </span>
                                                                </label>
                                                                <div class="col-md-4">
                                                                    <input type="text" class="form-control lg" name="outcome" id="outcome" placeholder="Add an outcome"/>

                                                                </div>
                                                                <div class="col-md-4">

                                                                    <a class="btn btn-success" onclick="saveoutcome(document.getElementById('outcome').value, document.getElementById('rowid').value)">Save</a>

                                                                    <a class="btn btn-danger" onclick="newoutcome()">New Outcome</a>

                                                                </div>
                                                                
                                                            </div>