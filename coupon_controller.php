<?php
# import the files
require_once('connection.php');
require_once('constant.php');

# Check the user is login into the system or not.
if ($_SESSION['user_id'] == "") {
    header("location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>MS CHAT</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/ms_chat_photo_3.ico">
    <!-- Icons Css -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="./assets/js/jquery-3.6.0.min.js"></script>
    <script language="javascript" src="includes/jscript_jqueryform.js"></script>
    <link href="assets/css/bootstrap.min.v0.2.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="assets/css/index.css">
    <script type="text/javascript" src="./assets/js/sweetalert.js"></script>
    <script type="text/javascript" src="./assets/js/select2.min.js"></script>
    <style>
        /* Increase font size and weight in dropdown options */
        .select2-results__option {
            font-size: 14px; /* Adjust font size */
            font-weight: bold; /* Adjust font weight */
        }

        /* Styling the selected value */
        .select2-selection__rendered {
            font-size: 14px; /* Adjust font size */
            font-weight: bold; /* Adjust font weight */
        }

        /* Styling the placeholder */
        .select2-selection__placeholder {
            font-size: 14px; /* Adjust font size */
            font-weight: normal; /* Placeholder font weight */
        }
    </style>
</head>

<body>

    <!-- MAIN CONTENT STARTS  -->
    <main class="main-content">

        <!-- FIRST SECTION CONTENT STARTS -->
        <section class="first-section">

            <!-- FIRST TABLE STARTS  -->
            <div>
                <fieldset>
                    <legend>Party BET Details</legend>
                    <div class="first-table-wrapper">
                        <table class="first-table">
                            <thead style ="position: sticky; top: 0; background-color: #f1f1f1; z-index: 1;">
                                <tr>
                                    <td class = "font" style ="width: 5%;">NO.</td>
                                    <td class = "font" style ="width: 17%;">Party Name</td>
                                    <td class = "font" style ="width: 13%;">Game</td>
                                    <td class = "font" style ="width: 30%;">Last Update</td>
                                    <td class = "font" style ="width: 8%;">Draw</td>
                                    <td class = "font" style ="width: 12%;">Amount</td>
                                    <td class = "font" style ="width: 15%;">Action</td>
                                </tr>
                            </thead>
                            <tbody id = 'row_bet'>
                            </tbody>
                        </table>
                    </div>
                </fieldset>
            </div>
            <!-- FIRST TABLE ENDS  -->

            <!-- FIRST SECTION BOTTOM GRID SECTION STARTS -->
            <div class="bottom-frid-section">

                <!-- FORM FIELDS SECTION STARTS -->
                <div class="bottom-form-section">
                    <fieldset>
                        <legend>Party Details</legend>
                        <div class="inline-form">
                            <label for="">Party</label>
                        </div>
                        <div class="inline-form">
                            <select id="party_select2" name="party_select2" style ="width: 100%; display: block; padding: 2px; font-weight: 700; text-align: -webkit-center; height: 30px; font-size: 13px;" class="js-example-basic-single js-states form-control" onchange="get_party_details()" autocomplete="off" disabled>
                            </select>
                            <input type="hidden" name="party" id="party" value="">
                        </div>
                        <div class="inline-form">
                            <label for="">Game</label>
                                <?php
                                if(isset($_GET['g_id']) && $_GET['g_id'] != ''){
                                    echo '<input type="text" name="game_name" id="game_name" value="'.$_GET['g_name'].'" readonly>';
                                    echo '<input type="hidden" name="game" id="game" value="'.$_GET['g_id'].'" readonly>';
                                }else{
                                    ?>
                                    <select name="game" id="game" onchange="get_game_details()">
                                    <option value=""></option>
                                    <?php
                                        if(isset($_SESSION['user_type']) && strtolower($_SESSION['user_type']) == 'admin'){
                                            $games_query = "SELECT `g_id`, `g_name` FROM `games` WHERE u_id IN (".$_SESSION['all_user_id'].") AND g_status != 'declare'";
                                        }else{
                                            $games_query = "SELECT `g_id`, `g_name` FROM `games` WHERE u_id IN (".$_SESSION['user_id'].") AND g_status != 'declare'";
                                        }
                                        
                                        $games_result = mysqli_query($con, $games_query);
                                        
                                        if (isset($games_result) && mysqli_num_rows($games_result) > 0) {
                                            while ($game = mysqli_fetch_assoc($games_result)) {
                                                echo '<option class="font" value="' . $game['g_id'] . '">' . $game['g_name'] . '</option>';
                                            }
                                        } else {
                                            echo '<option value="">No Games Found</option>';
                                        }     
                                    ?> 
                                    </select>
                                    <?php
                                }                           
                                ?>
                        </div>
                        <div class="inline-form">
                            <label   for="" >Date</label>
                            <input type="text" id="date" placeholder="Date" name = 'g_date_added' readonly>
                        </div>
                        <div class="inline-form">
                            <label for="">Draw</label>
                            <input type="text" name="draw" id="draw" readonly>
                        </div>
                        <div class="inline-form">
                            <label for="pati">Pati(%)</label>
                            <input type="text" name="pati" id="pati" value="" readonly>
                        </div>
                        <div class="inline-form">
                            <label for="limit">Limit</label>
                            <input type="text" name="limit" id="limit" value="" readonly>
                        </div>
                        <div class="inline-form">
                            <label for="">Sheet</label>
                        </div>
                        <div>
                            <select id="sheetDropdown" onchange="create_sheet()" style = "height: 25px; width: 100%; font-weight: bold; font-family: inherit; font-size: 14px;">
                                <option value="1">Main Sheet</option>
                                <option value="2">Final Sheet</option>
                                <option value="0">Party Sheet</option>
                                <?php if(isset($_SESSION['user_type']) && strtolower($_SESSION['user_type']) == 'admin' || strtolower($_SESSION['user_type']) == 'manager'){ ?>
                                <option value="3">Master Sheet</option>
                                <option value="4">Final Master Sheet</option>
                                <?php }?>
                            </select>
                        </div>
                        <div class="inline-form total-wrapper">
                            <label for="">Total</label>
                            <input type="number" name="total" id="total"  readonly>
                        </div>
                        <input type="hidden" name="user_id" id="user_id" value="<?php echo $_SESSION['user_id']; ?>">
                    </fieldset>
                </div>
                <!-- FORM FIELDS SECTION ENDS -->

                <!-- BOTTOM TABLE SECTION STARTS -->
                <div class="bottom-table-section">
                    <fieldset>
                        <legend>BET Insertion</legend>
                        <div class="first-table-wrapper">
                            <table class="first-table">
                                <thead style ="position: sticky; top: 0; background-color: #f1f1f1; z-index: 1;">
                                    <!-- First Row with Full Length -->
                                    <tr>
                                        <td class="font" id="party_name_heading" colspan="4" style="width: 100%; text-align: center; font-weight: bold;" value="">Party Name</td>
                                    </tr>
                                    <!-- Second Row with Defined Sections -->
                                    <tr>
                                        <td class = "font" style ="width: 5%;">No.</td>
                                        <td class = "font" style ="width: 55%;">Bet</td>
                                        <td class = "font" style ="width: 20%;">Amount</td>
                                        <td class = "font" style ="width: 20%;">Action</td>
                                    </tr>
                                </thead>
                                <tbody id = 'bet_numbers'>
                                </tbody>
                            </table>
                        </div>

                        <!-- BOTTOM TABLE FORMS AREA STARTS -->
                        <form id="game_entry_data" action="" method="post">
                        <div class="bottom-table-form-area">
                            <div>
                            <label for="input_type"><b>BET</b></label>
                            <br>
                            <input type="text" name="bet_row_input" autocomplete="off" id="bet_row_input" class="mt-6" style="width: 270px;height: 25px;font-size: large;">
                          </div>
                          <div class="slash">/</div>
                          <div class="block-form">
                            <label for=""><b>Rs</b></label>
                            <input type="number" name="rupees_input" autocomplete="off" id="rupees_input" style="height: 25px;font-size: large;">
                          </div>
                        </div>
                        <!-- BOTTOM TABLE FORMS AREA ENDS -->

                        <div class="inline-form inline-form-sm">
                          <label for="">No of Pair</label>
                          <input type="number" name="number_of_bet_pairs" id="number_of_bet_pairs" style="height: 25px;width: 50px;" readonly>
                        </div>

                            <div class="action-buttons-area">
                                <a href="/ms-chat/index.php">
                                    <img src="assets/images/home.png">
                                </a>
                                <a onclick="clear_party_details()">
                                    <img src="assets/images/cross.png">
                                </a>
                            </div>
                    </fieldset>
                </div>
                </form>
                <!-- BOTTOM TABLE SECTION ENDS -->
            </div>
            <!-- FIRST SECTION BOTTOM GRID SECTION ENDS -->

        </section>
        <!-- FIRST CONTENT SECTION ENDS -->

        <!-- SECOND CONTENT SECTION STARTS -->
        <section class="second-section">

            <!-- SECOND TABLE STARTS -->
            <div>
                <fieldset>
                    <legend>BET</legend>
                    <div id = "sheet-div">
                        <div id = "sheet-title">
                                Main Sheet 
                        </div>
                    </div>
                    <div class="second-table-wrapper">
                        <table class="second-table">
                            <thead style ="position: sticky; top: 0; background-color: #f1f1f1; z-index: 1;" id = 'bet_header'>
                                <tr>
                                    <td>No.</td>
                                    <td>Rs.</td>
                                    <td>No.</td>
                                    <td>Rs.</td>
                                    <td>No.</td>
                                    <td>Rs.</td>
                                    <td>No.</td>
                                    <td>Rs.</td>
                                    <td>No.</td>
                                    <td>Rs.</td>
                                    <td>No.</td>
                                    <td>Rs.</td>
                                </tr>
                            </thead>
                            <tbody id = 'bet'>
                                <tr>
                                    <td>01</td>
                                    <td>0</td>
                                    <td>21</td>
                                    <td>0</td>
                                    <td>41</td>
                                    <td>0</td>
                                    <td>61</td>
                                    <td>0</td>
                                    <td>81</td>
                                    <td>0</td>
                                    <td>A0</td>
                                    <td>0</td>
                                </tr>
                                <tr>
                                    <td>02</td>
                                    <td>0</td>
                                    <td>22</td>
                                    <td>0</td>
                                    <td>42</td>
                                    <td>0</td>
                                    <td>62</td>
                                    <td>0</td>
                                    <td>82</td>
                                    <td>0</td>
                                    <td>A1</td>
                                    <td>0</td>
                                </tr>
                                <tr>
                                    <td>03</td>
                                    <td>0</td>
                                    <td>23</td>
                                    <td>0</td>
                                    <td>43</td>
                                    <td>0</td>
                                    <td>63</td>
                                    <td>0</td>
                                    <td>83</td>
                                    <td>0</td>
                                    <td>A2</td>
                                    <td>0</td>
                                </tr>
                                <tr>
                                    <td>04</td>
                                    <td>0</td>
                                    <td>24</td>
                                    <td>0</td>
                                    <td>44</td>
                                    <td>0</td>
                                    <td>64</td>
                                    <td>0</td>
                                    <td>84</td>
                                    <td>0</td>
                                    <td>A3</td>
                                    <td>0</td>
                                </tr>
                                <tr>
                                    <td>05</td>
                                    <td>0</td>
                                    <td>25</td>
                                    <td>0</td>
                                    <td>45</td>
                                    <td>0</td>
                                    <td>65</td>
                                    <td>0</td>
                                    <td>85</td>
                                    <td>0</td>
                                    <td>A4</td>
                                    <td>0</td>
                                </tr>
                                <tr>
                                    <td>06</td>
                                    <td>0</td>
                                    <td>26</td>
                                    <td>0</td>
                                    <td>46</td>
                                    <td>0</td>
                                    <td>66</td>
                                    <td>0</td>
                                    <td>86</td>
                                    <td>0</td>
                                    <td>A5</td>
                                    <td>0</td>
                                </tr>
                                <tr>
                                    <td>07</td>
                                    <td>0</td>
                                    <td>27</td>
                                    <td>0</td>
                                    <td>47</td>
                                    <td>0</td>
                                    <td>67</td>
                                    <td>0</td>
                                    <td>87</td>
                                    <td>0</td>
                                    <td>A6</td>
                                    <td>0</td>
                                </tr>
                                <tr>
                                    <td>08</td>
                                    <td>0</td>
                                    <td>28</td>
                                    <td>0</td>
                                    <td>48</td>
                                    <td>0</td>
                                    <td>68</td>
                                    <td>0</td>
                                    <td>88</td>
                                    <td>0</td>
                                    <td>A7</td>
                                    <td>0</td>
                                </tr>
                                <tr>
                                    <td>09</td>
                                    <td>0</td>
                                    <td>29</td>
                                    <td>0</td>
                                    <td>49</td>
                                    <td>0</td>
                                    <td>69</td>
                                    <td>0</td>
                                    <td>89</td>
                                    <td>0</td>
                                    <td>A8</td>
                                    <td>0</td>
                                </tr>
                                <tr>
                                    <td>10</td>
                                    <td>0</td>
                                    <td>30</td>
                                    <td>0</td>
                                    <td>50</td>
                                    <td>0</td>
                                    <td>70</td>
                                    <td>0</td>
                                    <td>90</td>
                                    <td>0</td>
                                    <td>A9</td>
                                    <td>0</td>
                                </tr>
                                <tr>
                                    <td>11</td>
                                    <td>0</td>
                                    <td>31</td>
                                    <td>0</td>
                                    <td>51</td>
                                    <td>0</td>
                                    <td>71</td>
                                    <td>0</td>
                                    <td>91</td>
                                    <td>0</td>
                                    <td>B0</td>
                                    <td>0</td>
                                </tr>
                                <tr>
                                    <td>12</td>
                                    <td>0</td>
                                    <td>32</td>
                                    <td>0</td>
                                    <td>52</td>
                                    <td>0</td>
                                    <td>72</td>
                                    <td>0</td>
                                    <td>92</td>
                                    <td>0</td>
                                    <td>B1</td>
                                    <td>0</td>
                                </tr>
                                <tr>
                                    <td>13</td>
                                    <td>0</td>
                                    <td>33</td>
                                    <td>0</td>
                                    <td>53</td>
                                    <td>0</td>
                                    <td>73</td>
                                    <td>0</td>
                                    <td>93</td>
                                    <td>0</td>
                                    <td>B2</td>
                                    <td>0</td>
                                </tr>
                                <tr>
                                    <td>14</td>
                                    <td>0</td>
                                    <td>34</td>
                                    <td>0</td>
                                    <td>54</td>
                                    <td>0</td>
                                    <td>74</td>
                                    <td>0</td>
                                    <td>94</td>
                                    <td>0</td>
                                    <td>B3</td>
                                    <td>0</td>
                                </tr>
                                <tr>
                                    <td>15</td>
                                    <td>0</td>
                                    <td>35</td>
                                    <td>0</td>
                                    <td>55</td>
                                    <td>0</td>
                                    <td>75</td>
                                    <td>0</td>
                                    <td>95</td>
                                    <td>0</td>
                                    <td>B4</td>
                                    <td>0</td>
                                </tr>
                                <tr>
                                    <td>16</td>
                                    <td>0</td>
                                    <td>36</td>
                                    <td>0</td>
                                    <td>56</td>
                                    <td>0</td>
                                    <td>76</td>
                                    <td>0</td>
                                    <td>96</td>
                                    <td>0</td>
                                    <td>B5</td>
                                    <td>0</td>
                                </tr>
                                <tr>
                                    <td>17</td>
                                    <td>0</td>
                                    <td>37</td>
                                    <td>0</td>
                                    <td>57</td>
                                    <td>0</td>
                                    <td>77</td>
                                    <td>0</td>
                                    <td>97</td>
                                    <td>0</td>
                                    <td>B6</td>
                                    <td>0</td>
                                </tr>
                                <tr>
                                    <td>18</td>
                                    <td>0</td>
                                    <td>38</td>
                                    <td>0</td>
                                    <td>58</td>
                                    <td>0</td>
                                    <td>78</td>
                                    <td>0</td>
                                    <td>98</td>
                                    <td>0</td>
                                    <td>B7</td>
                                    <td>0</td>
                                </tr>
                                <tr>
                                    <td>19</td>
                                    <td>0</td>
                                    <td>39</td>
                                    <td>0</td>
                                    <td>59</td>
                                    <td>0</td>
                                    <td>79</td>
                                    <td>0</td>
                                    <td>99</td>
                                    <td>0</td>
                                    <td>B8</td>
                                    <td>0</td>
                                </tr>
                                <tr>
                                    <td>20</td>
                                    <td>0</td>
                                    <td>40</td>
                                    <td>0</td>
                                    <td>60</td>
                                    <td>0</td>
                                    <td>80</td>
                                    <td>0</td>
                                    <td>100</td>
                                    <td>0</td>
                                    <td>B9</td>
                                    <td>0</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- SECOND TABLE ENDS -->

                    <!-- TABLE BOTTOM CONTENT STARTS  -->
                    <div class="second-table-content-section">
                        <div class="pricing-details">
                            <div class="01-100">
                                Total 1-100 : <input type="number" style ="font-weight: 700; width: 90px;" name="" id="01-100" readonly>
                            </div>
                            <div class="grand_total">
                                Grand Total : <input type="number" style ="font-weight: 700; width: 90px;" name="" id="total_bet" readonly>
                            </div>
                            <div class="AB">
                                Total AB : <input type="number" style ="font-weight: 700; width: 90px;" name="" id="AB" readonly>
                            </div>
                        </div>

                        <div class="section-wise-pricing">
                            <div>
                                <div>
                                    <label for="">01-10</label> <input type="number" style ="font-weight: 700;" name="" id="01-10" readonly>
                                </div>
                                <div>
                                    <label for="">11-20</label> <input type="number" style ="font-weight: 700;" name="" id="11-20" readonly>
                                </div>
                            </div>
                            <div>
                                <div>
                                    <label for="">21-30</label> <input type="number" style ="font-weight: 700;" name="" id="21-30" readonly>
                                </div>
                                <div>
                                    <label for="">31-40</label> <input type="number" style ="font-weight: 700;" name="" id="31-40" readonly>
                                </div>
                            </div>
                            <div>
                                <div>
                                    <label for="">41-50</label> <input type="number" style ="font-weight: 700;" name="" id="41-50" readonly>
                                </div>
                                <div>
                                    <label for="">51-60</label> <input type="number" style ="font-weight: 700;" name="" id="51-60" readonly>
                                </div>
                            </div>
                            <div>
                                <div>
                                    <label for="">61-70</label> <input type="number" style ="font-weight: 700;" name="" id="61-70" readonly>
                                </div>
                                <div>
                                    <label for="">71-80</label> <input type="number" style ="font-weight: 700;" name="" id="71-80" readonly>
                                </div>
                            </div>
                            <div>
                                <div>
                                    <label for="">81-90</label> <input type="number" style ="font-weight: 700;" name="" id="81-90" readonly>
                                </div>
                                <div>
                                    <label for="">91-100</label> <input type="number" style ="font-weight: 700;" name="" id="91-100" readonly>
                                </div>
                            </div>
                            <div>
                                <div>
                                    <label for="">A0-A9</label> <input type="number" style ="font-weight: 700;" name="" id="a0-a9" readonly>
                                </div>
                                <div>
                                    <label for="">B0-B9</label> <input type="number" style ="font-weight: 700;" name="" id="b0-b9" readonly>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- TABLE BOTTOM CONTENT ENDS  -->
                </fieldset>
            </div>
        </section>
        <style>
            .side_button{
                width: 80%;
                height: 30px;
                margin-top: 10px;
                background-color: slategrey;
                color: white;
                border: none;
                font-size: larger;
                cursor: pointer;
                margin-left: 13px;
                border-radius: 3px;
            }
            .side_button:hover {
                background-color: grey;
            }
            .link_button{
                color: white;
                text-decoration: none;
            }
        </style>
        <!-- SECOND CONTENT SECTION ENDS -->
        <!-- THIRD CONTENT SECTION STARTS -->
        <section class="third-section">
          <fieldset>
            <legend>Action</legend>
            <div style="padding-left: 35px;">
                <h4><?php echo $_SESSION['user_name']?></h4>
            </div>
            <?php if(isset($_SESSION['user_type']) && (strtolower($_SESSION['user_type']) == 'admin')){ ?>
                <a class = "link_button" href="user_controller.php"><button class = "side_button" >User</button></a>
            <?php } ?>
            <a class = "link_button" href="party_controller.php"><button class = "side_button" >Party</button></a>
            <a class = "link_button" href="game_controller.php"><button class = "side_button" >Game</button></a>
            <a class = "link_button" href="game_history_controller.php"><button class = "side_button" >History</button></a>
            <hr>
            <button class = "side_button" onclick="create_sheet('','',1)" >Round Figure</button>
            <button class = "side_button" onclick="create_sheet('','',5)">Round 0/5</button>
            <hr>
            <label for="Party Section" style= "font-size: larger; font-weight: 600; margin-left: 15px;">Party Section</label>
            <select  style = " width: 70%; display: block; padding: 2px; margin: 10px 0px 10px 15px; font-weight: 600; text-align: -webkit-center; height: 30px; font-size: 13px;" name="fetch_party" id="fetch_party" onchange="fetch_party_list()">
                <option value="<?php echo $_SESSION['user_id'] ?>">My Party</option>
                <option value="all">All Party</option>
            </select>
            <!-- code for logout button -->
            <a class = "link_button" href='#' onclick = 'insert_bet_data()'><button class = "side_button" style = "margin-left: 13px;">Empty Basket</button></a>
            <!-- <a class = "link_button" href='#' onclick = 'edit_bet_data()'><button class = "side_button" style = "margin-left: 13px;">Edit Basket</button></a> -->
            <br>
            <a class = "link_button" href='logout.php'><button class = "side_button" style = "margin-left: 13px;">Logout</button></a>
          </fieldset>
        </section>
        <!-- THIRD CONTENT SECTION ENDS -->
  </main>
  <!-- MAIN CONTENT ENDS  -->
  <!-- Popup and overlay elements -->
  <div class="overlay" id="overlay"></div>
  <div class="popup" id="popup">
      <h3> ERROR</h3>
      <p id="error_message" style = 'height: 130px; width: 260px; text-align: center; padding-top: 30px; font-size: large; color: red; font-family: inherit;'></p>
      <button class="button" onclick="hidePopup()">OK</button>
  </div>

  <div class="second-table-wrapper" id="final_sheet">
  <button class="close-button" id="close_button">&times;</button>
    <h3><b>Final Sheet</b></h3>
    <table class="second-table-2">
        <thead>
            <tr>
                <td>No.</td>
                <td>Rs.</td>
                <td>No.</td>
                <td>Rs.</td>
                <td>No.</td>
                <td>Rs.</td>
                <td>No.</td>
                <td>Rs.</td>
                <td>No.</td>
                <td>Rs.</td>
            </tr>
        </thead>
        <tbody id = 'sheet'>
        </tbody>
    </table>
  </div>
  <input type="hidden" name="action" id="action" value="">
  <input type="hidden" name="crd_id" id="crd_id" value="">
</body>
  <!-- <script language="javascript" src="includes/jquery-1.6.1.min.js"></script> -->
  <script language="javascript" src="includes/jscript_jqueryform.js"></script>
  <!-- <script language="javascript" src="includes/jquery-ui-1.8rc3.custom.min.js"></script> -->
  <!-- <script type="text/javascript" src="includes/ui.dropdownchecklist.js"></script> -->
  <script type="text/javascript" src="assets/js/common_function.js"></script>
  <script>
    $(document).ready(function () {
        // Initialize Select2
        $('.js-example-basic-single').select2({
            placeholder: "Select Party",
            matcher: function (params, data) {
                    // If no search term, return all results
                    if ($.trim(params.term) === '') {
                        return data;
                    }

                    // Perform case-insensitive comparison starting with the first letter
                    if (data.text.toLowerCase().startsWith(params.term.toLowerCase())) {
                        return data;
                    }

                    // Return null if there's no match
                    return null;
                }
        });
        // Autofocus on search input when dropdown is opened
        $('.js-example-basic-single').on('select2:open', function () {
            document.querySelector('.select2-search__field').focus();
        });
    });
    // Select all inputs of type 'number'
    const numberInputs = document.querySelectorAll('input[type="number"]');

    // Loop through all the number inputs and add event listeners
    numberInputs.forEach(function(numberInput) {
        numberInput.addEventListener('keydown', function(event) {
            const invalidChars = ['/', '-', '*', '+', 'e', 'E', '.']; 
            if (invalidChars.includes(event.key)) {
                event.preventDefault();  // Prevent the character from being entered
            }

            // Disable up arrow (ArrowUp) and down arrow (ArrowDown)
            if (event.key === "ArrowUp" || event.key === "ArrowDown") {
                event.preventDefault(); // Prevent the number from changing
            }
        });
    });
  </script>
</html>