<section>
            <section class="main-content">
               <h3>{block_title}</h3>
               <div class="row">
                  <div class="col-md-12">
                     <div class="row">
                        <div class="col-lg-3 col-sm-6">
                           <div data-toggle="play-animation" data-play="fadeInDown" data-offset="0" data-delay="100" class="panel widget">
                              <div class="panel-body bg-primary">
                                 <div class="row row-table row-flush">
                                    <div class="col-xs-12">
                                       <p class="mb0">{trust_line}
                                       </p>
                                       <h4 class="m0">Total Trust</h4>
                                       <span class="m-t-10"><i class="fa fa-exchange"></i> Trust Total
                                       </span>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                           <div data-toggle="play-animation" data-play="fadeInDown" data-offset="0" data-delay="500" class="panel widget">
                              <div class="panel-body bg-warning">
                                 <div class="row row-table row-flush">
                                    <div class="col-xs-12">
                                       <p class="mb0">{trade_volume} </p>
                                       <h4 class="m0">Trade Volume</h4>
                                       <span class="f-left m-t-10">
                                       <i class="fa fa-dollar"></i> 24h Trade Volume
                                       </span>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                           <div data-toggle="play-animation" data-play="fadeInDown" data-offset="0" data-delay="1000" class="panel widget">
                              <div class="panel-body bg-danger">
                                 <div class="row row-table row-flush">
                                    <div class="col-xs-12">
                                       <p class="mb0">{last_trade} <em class="fa fa-refresh"></em></p>
                                       <h4 class="m0">Last Trade</h4>
                                       <span class="m-t-10">
                                       <i class="text-c-green f-16 fa fa-refresh"></i> Last Trade
                                       </span>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                           <div data-toggle="play-animation" data-play="fadeInDown" data-offset="0" data-delay="1500" class="panel widget">
                              <div class="panel-body bg-success">
                                 <div class="row row-table row-flush">
                                    <div class="col-xs-12">
                                       <p class="mb0">{total_supply} <em class="fa fa-money"></em></p>
                                       <h4 class="m0">Total Supply</h4>
                                       <span class="f-left m-t-10">
                                       <i class="fa fa-money"></i> Total Supply
                                       </span>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-lg-12">
                           <div class="panel panel-default">
                              <div class="panel-collapse">
                                 <div class="panel-body">
                                    <h4>{block_title}</h4>
                                    <div id="chart_trade" class="h-500">

                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-6">
                           <div data-toggle="play-animation" data-play="fadeInLeft" data-offset="0" data-delay="1400" class="panel widget">
                              <div class="panel-body">
                                 <div class="text-right text-muted">
                                    <em class="fa fa-gavel fa-2x text-danger"></em>
                                 </div>
                                 <h3 class="mt0">Bid Price</h3>
                                 <p class="text-danger"></i> {bid_price} XLM</p>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div data-toggle="play-animation" data-play="fadeInLeft" data-offset="0" data-delay="1400" class="panel widget">
                              <div class="panel-body">
                                 <div class="text-right text-muted">
                                    <em class="fa fa-bullhorn fa-2x text-green"></em>
                                 </div>
                                 <h3 class="mt0">Ask Price</h3>
                                 <p class="text-green">{ask_price} XLM</p>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>

               </div>
               <div class="row">
                  <div class="col-lg-6">
                     <div class="panel panel-default">
                        <div class="panel-heading">Bid Price
                           <a href="#" data-perform="panel-collapse" data-toggle="tooltip" title="Collapse Panel" class="pull-right">
                           <em class="fa fa-minus"></em>
                           </a>
                        </div>
                        <div class="pannel panel-body">
                           <label class="col-sm-2 control-label m-t-9">Units</label>
                           <div class="input-group col-sm-10 m-b">
                              <span class="input-group-addon btn-primary group-btn-hover"><i class="fa fa-angle-double-up"></i> Max</span>
                              <input type="text" placeholder="0.00000000" class="form-control text-right">
                           </div>
                           <div class="m-t-9">
                              <label class="col-sm-2 control-label m-t-9">Bid</label>
                              <div class="input-group m-b">
                                 <div class="input-group-btn">
                                    <button type="button" data-toggle="dropdown" class="btn btn-default dropdown-toggle">Price
                                  </button>
                                 </div>
                                 <input type="text" class="form-control text-right" placeholder="0.00000000">
                              </div>
                           </div>

                           <div class="m-t-9">
                              <label class="col-sm-2 control-label m-t-9">Total</label>
                              <div class="input-group col-sm-10 m-b">
                                 <span class="input-group-addon"><i class="fa fa-btc"></i></span>
                                 <input type="text" placeholder="0.00000000" class="form-control text-right">
                              </div>
                           </div>
                           <div class="m-t-9">
                              <button type="button" class="btn btn-primary btn-block"><i class="fa fa-plus"></i> Buy {name_asset}</button>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-6">
                     <div class="panel panel-default">
                        <div class="panel-heading">Ask Price
                           <a href="#" data-perform="panel-collapse" data-toggle="tooltip" title="Collapse Panel" class="pull-right">
                           <em class="fa fa-minus"></em>
                           </a>
                        </div>
                        <div class="pannel panel-body">
                           <label class="col-sm-2 control-label m-t-9">Units</label>
                           <div class="input-group col-sm-10 m-b">
                              <span class="input-group-addon btn-primary group-btn-hover"><i class="fa fa-angle-double-up"></i> Max</span>
                              <input type="text" placeholder="0.00000000" class="form-control text-right">
                           </div>
                           <div class="m-t-9">
                              <label class="col-sm-2 control-label m-t-9">Ask</label>
                              <div class="input-group m-b">
                                 <div class="input-group-btn">
                                    <button type="button" data-toggle="dropdown" class="btn btn-default dropdown-toggle">Price
                                    </button>

                                 </div>
                                 <input type="text" class="form-control text-right" placeholder="0.00000000">
                              </div>
                           </div>

                           <div class="m-t-9">
                              <label class="col-sm-2 control-label m-t-9">Total</label>
                              <div class="input-group col-sm-10 m-b">
                                 <span class="input-group-addon"><i class="fa fa-btc"></i></span>
                                 <input type="text" placeholder="0.00000000" class="form-control text-right">
                              </div>
                           </div>
                           <div class="m-t-9">
                              <button type="button" class="btn btn-primary btn-block"><i class="fa fa-minus"></i> Sell {name_asset}</button>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- Orders Book -->
               <div class="row">
               <div class="col-md-12">
                  <div class="panel panel-default">
                     <div class="panel-heading">Orders Book
                        <a href="javascript:void(0);" data-perform="panel-collapse" data-toggle="tooltip" title="" class="pull-right" data-original-title="Collapse Panel">
                        <em class="fa fa-minus"></em>
                        </a>
                     </div>
                     <div class="panel-heading border-none">

                     </div>
                     <div class="panel-body">
                        <div class="row">
                           <div class="col-md-6 col-sm-12">
                              <div class="table-responsive m-t-10">
                                 <table class="table table-striped table-hover table-condensed" id="bid_table">
                                    <thead>
                                       <tr>
                                          <th>
                                             Price
                                          </th>
                                          <th>
                                             Qty ({name_asset})
                                          </th>
                                          <th>
                                             Total
                                          </th>
                                       </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                 </table>
                              </div>
                           </div>
                           <div class="col-md-6 col-sm-12">
                              <div class="table-responsive">
                                 <table class="table table-striped table-hover table-condensed" id="ask_table">
                                    <thead>
                                       <tr>
                                          <th>
                                             Price
                                          </th>
                                          <th>
                                             Qty ({name_asset})
                                          </th>
                                          <th>
                                             Total
                                          </th>
                                       </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                 </table>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- Open Orders -->
               <div class="col-md-12">
                  <div class="panel panel-default">
                     <div class="panel-heading">Open Orders
                        <a href="#" data-perform="panel-collapse" data-toggle="tooltip" title="Collapse Panel" class="pull-right">
                        <em class="fa fa-minus"></em>
                        </a>
                     </div>
                     <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                           <thead>
                              <tr>
                                 <th><i class="fa fa-plus"></i></th>
                                 <th>Order Date</th>
                                 <th>Type</th>
                                 <th>Bid/Ask</th>
                                 <th>Units Filled {name_asset}</th>
                                 <th>Units Total {name_asset}</th>
                                 <th>Actual Rate</th>
                                 <th>Estimated Total IGNIS</th>
                                 <th><i class="fa fa-times"></i></th>
                              </tr>
                           </thead>
                           <tbody>

                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
               <!-- Market History -->
               <div class="col-md-12">
                  <div class="panel panel-default">
                     <div class="panel-heading">Market History
                        <a href="#" data-perform="panel-collapse" data-toggle="tooltip" title="Collapse Panel" class="pull-right">
                        <em class="fa fa-minus"></em>
                        </a>
                     </div>
                     <div class="panel-body">
                       <div class="table-responsive">
                          <table class="table table-striped table-hover" id="market_history">
                             <thead>
                                 <th>Date</th>
                                 <th>Type</th>
                                 <th>Quantity</th>
                                 <th>Price</th>
                             </thead>
                             <tbody>

                             </tbody>
                          </table>
                       </div>
                     </div>
                  </div>
               </div>
               <!-- My Order History -->
               <div class="col-md-12">
                  <div class="panel panel-default">
                     <div class="panel-heading">My Order History
                        <a href="#" data-perform="panel-collapse" data-toggle="tooltip" title="Collapse Panel" class="pull-right">
                        <em class="fa fa-minus"></em>
                        </a>
                     </div>
                     <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                           <thead>
                              <tr>
                                 <th>Closed Date</th>
                                 <th>Opened Date</th>
                                 <th>Type</th>
                                 <th>Bid/Ask</th>
                                 <th>Units Filled {name_asset}</th>
                                 <th>Units Total {name_asset}</th>
                                 <th>Actual Rate</th>
                                 <th>Cost/Proceeds</th>
                              </tr>
                           </thead>
                           <tbody>

                           </tbody>
                        </table>
                     </div>
                     <div class="panel-footer">

                     </div>
                  </div>
               </div>
            </div>
            </section>
