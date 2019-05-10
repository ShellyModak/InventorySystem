<form class="form-horizontal">
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Phone Number</label>
                                        <div class="col-lg-8">
                                            <input type="text" class="form-control" id="phone" placeholder="Phone" onblur="getName(this.value);">
                                             <span id="Phone_error" style="color: red"></span><br>
                                        </div>
                                         
                                    </div>
                                    
                                     <div class="form-group">
                                        <label class="col-lg-2 control-label">Name</label>
                                        <div class="col-lg-8">
                                            <input type="text" class="form-control" id="name" placeholder="Name">
                                             <span id="name_error" style="color: red"></span><br>
                                   </div>
                                       
                                    </div>
                                    
                             <div class="form-group">
                                        <label class="col-lg-2 control-label">Total Price</label>
                                        <div class="col-lg-8">
                                           <input type="text" class="form-control"  id="price" placeholder="Price" readonly>
                                        </div>
                                    </div>
                                      <div class="form-group">
                                        <label class="col-lg-2 control-label">Discount</label>
                                        <div class="col-lg-8">
                                           <input type="text" class="form-control"  id="discountAmount" readonly>
                                        </div>
                                          
                                          
                                    </div>
                                    
                                     <div class="form-group">
                                        <label class="col-lg-2 control-label">Overall Price</label>
                                        <div class="col-lg-8">
                                           <input type="text" class="form-control"  id="cost" placeholder="Price" readonly>
                                        </div>
                                          
                                          
                                    </div>
                                    
                                </form>