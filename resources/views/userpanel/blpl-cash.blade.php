@include('userpanel.header')


<div class="userpanel-right">
    <div class="userpanel-vector">
        <img src="{{url('public/userpanel/images/user-vector1.webp')}}" class="vector1" alt="Logout Icon" />
        <img src="{{url('public/userpanel/images/user-vector2.webp')}}" class="vector2" alt="Logout Icon" />
        <img src="{{url('public/userpanel/images/user-vector3.webp')}}" class="vector3" alt="Logout Icon" />
        <div class="panel-main">
            <div class="user-dropdown">
                <div class="left-wrap">
                    <div class="left-icon">
                        <img src="{{url('public/userpanel/images/anshika-bist.webp')}}" alt="User Icon" />
                    </div>
                </div>
                <div class="right-wraps">
                    <ul>
                        <li class="dropdown">
                            <a class="link-btn dropdown-toggle" type="button" id="dropdownMenuButton"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Anshika
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

            <h3 class="heading">Aayurja Cash</h3>

            <div class="user-form cash-wrapper">
                <div class="cash-items">
                    <div class="cash-col">
                        <div class="cash-col-inner">
                            <img src="{{url('public/userpanel/images/coins-icon.webp')}}" alt="User Icon" />
                        </div>

                        <div class="cash-col-content">
                            <h4>2324</h4>
                            <p>Total Coins</p>
                        </div>
                    </div>

                    <div class="cash-col">
                        <div class="cash-col-inner">
                            <img src="{{url('public/userpanel/images/gift-panel.webp')}}" alt="User Icon" />
                        </div>

                        <div class="cash-col-content">
                            <h4>0</h4>
                            <p>Amount Redeemed</p>
                        </div>
                    </div>

                    <div class="cash-col">
                        <div class="cash-col-inner">
                            <img src="{{url('public/userpanel/images/parcel-img.webp')}}" alt="User Icon" />
                        </div>

                        <div class="cash-col-content">
                            <h4>0</h4>
                            <p>Available Balance</p>
                        </div>
                    </div>
                </div>

                <div class="earned-section">
                    <h1>Coins Earned</h1>
                    <div class="earned-wraps">
                        <table class="rwd-table">
                            <tbody>
                                <tr>
                                    <th>Date</th>
                                    <th>Aayurja Coins Earned</th>
                                    <th>Transaction ID</th>
                                    <th>Order Amount</th>
                                    <th>Transaction Type</th>
                                    <th>Net Amount</th>
                                </tr>
                                <tr>
                                    <td>12/07/ 2024</td>
                                    <td>1800</td>
                                    <td>GH56BBF321</td>
                                    <td>₹12,999</td>
                                    <td>razorpay</td>
                                    <td>SF5543NN2</td>
                                </tr>
                                <tr>
                                    <td>22/01/ 2024</td>
                                    <td>276</td>
                                    <td>ER643VB65E</td>
                                    <td>₹19,949</td>
                                    <td>COD</td>
                                    <td>DGT22H2J</td>
                                </tr>
                                <tr>
                                    <td>02/12/ 2023</td>
                                    <td>BOX Pro West</td>
                                    <td>ASDF43000</td>
                                    <td>6/27/2016</td>
                                    <td>12/25/2016</td>
                                    <td>$45,255.49</td>
                                </tr>
                                <tr>
                                    <td>10/09/ 2023</td>
                                    <td>3234</td>
                                    <td>SWQ127RES1</td>
                                    <td>₹1,299</td>
                                    <td>razor + COD</td>
                                    <td>ANY2211YT</td>
                                </tr>

                                <tr>
                                    <td>10/09/ 2023</td>
                                    <td>2000</td>
                                    <td>VD89FGRT56</td>
                                    <td>₹10,999</td>
                                    <td>COD</td>
                                    <td>NAW6657W</td>
                                </tr>

                                <tr>
                                    <td>12/07/ 2024</td>
                                    <td>1800</td>
                                    <td>GH56BBF321</td>
                                    <td>₹12,999</td>
                                    <td>razorpay</td>
                                    <td>SF5543NN2</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="earned-section">
                    <h1>Redeem History</h1>
                    <div class="earned-wraps">
                        <table class="rwd-table">
                            <tbody>
                                <tr>
                                    <th>Date</th>
                                    <th>Aayurja Coins Earned</th>
                                    <th>Transaction ID</th>
                                    <th>Order Amount</th>
                                    <th>Transaction Type</th>
                                    <th>Net Amount</th>
                                </tr>
                                <tr>
                                    <td>12/07/ 2024</td>
                                    <td>1800</td>
                                    <td>GH56BBF321</td>
                                    <td>₹12,999</td>
                                    <td>razorpay</td>
                                    <td>SF5543NN2</td>
                                </tr>
                                <tr>
                                    <td>22/01/ 2024</td>
                                    <td>276</td>
                                    <td>ER643VB65E</td>
                                    <td>₹19,949</td>
                                    <td>COD</td>
                                    <td>DGT22H2J</td>
                                </tr>
                                <tr>
                                    <td>02/12/ 2023</td>
                                    <td>BOX Pro West</td>
                                    <td>ASDF43000</td>
                                    <td>6/27/2016</td>
                                    <td>12/25/2016</td>
                                    <td>$45,255.49</td>
                                </tr>
                                <tr>
                                    <td>10/09/ 2023</td>
                                    <td>3234</td>
                                    <td>SWQ127RES1</td>
                                    <td>₹1,299</td>
                                    <td>razor + COD</td>
                                    <td>ANY2211YT</td>
                                </tr>

                                <tr>
                                    <td>10/09/ 2023</td>
                                    <td>2000</td>
                                    <td>VD89FGRT56</td>
                                    <td>₹10,999</td>
                                    <td>COD</td>
                                    <td>NAW6657W</td>
                                </tr>

                                <tr>
                                    <td>12/07/ 2024</td>
                                    <td>1800</td>
                                    <td>GH56BBF321</td>
                                    <td>₹12,999</td>
                                    <td>razorpay</td>
                                    <td>SF5543NN2</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>

@include('userpanel.footer')