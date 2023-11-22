<?php
require_once '../classes/bloodBank.php';
require_once '../classes/district.php';

use classes\district;
use classes\bloodBank;

$bloodBankId = $user->getBloodBankId();
$bloodBank = new bloodBank($bloodBankId, null, null, null, null);
$bloodBank->GetBloodbankData($bloodBankId);
$Location = district::getDistrictDivisionById($bloodBank->getBloodBankId());
?>

<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>

<head>
  <meta charset="UTF-8">



  <title></title>
</head>

<body>

  <!-- nav bar start -->
  <div class="sticky-top bg-white shadownav" style="height: 50px;">
    <div class="row m-0 d-flex">
      <div class="col-9">

      </div>


      <div class="col-3">
        <div class="row align-items-center">

          <div class=" mt-2 	d-none d-xl-block">
            <b><?php echo $bloodBank->getBloodBankName() ?></b>
            <p style="font-size: 10px;">Hospital</p>
          </div>
        </div>

      </div>


    </div>
  </div>
  <!-- nav bar end -->







  <!-- body start -->
  <div class="mt-5 m-4 mb-2" style="color:gray;">
    <h5>BloodBank Profile</h5>
  </div>

  <div class="row bg-white m-3 pt-0  align-items-center justify-content-center rounded-5" style="height: 600px;">

    <div class="col-lg-6">
      <div class="form-container" style="margin-left:100px;width: 500px">
        <div class="card-body">

          <div class="row">
            <div class="col-sm-4">
              <p class="mb-0"><span class="fw-bold">BloodBank Name</span></p>
            </div>
            <div class="col-sm-7">
              <p class="text-muted mb-0"><?php echo $bloodBank->getBloodBankName(); ?></p>
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="col-sm-4">
              <p class="mb-0"><span class="fw-bold">contactNumber</span></p>
            </div>
            <div class="col-sm-7">
              <p class="text-muted mb-0"><?php echo $bloodBank->getContactNo(); ?></p>
            </div>
          </div>
          <hr>

          <div class="row">
            <div class="col-sm-4">
              <p class="mb-0"><span class="fw-bold">District</span></p>
            </div>
            <div class="col-sm-7">
              <p class="text-muted mb-0"><?php echo $Location["district"] ?></p>
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="col-sm-4">
              <p class="mb-0"><span class="fw-bold">Division</span></p>
            </div>
            <div class="col-sm-7">
              <p class="text-muted mb-0"><?php echo $Location["division"] ?></p>
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="col-sm-4">
              <p class="mb-0"><span class="fw-bold">Address</span></p>
            </div>
            <div class="col-sm-7">
              <p class="text-muted mb-0"><?php echo $bloodBank->getAddress(); ?></p>
            </div>
          </div>

          <div class="text-end">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Edit</button>
          </div>

          

        </div>

      </div>
    </div>
    <div class="col-6 align-items-center justify-content-center">
      <img class="d-none d-xl-block" src="../Images/hospitalprof.jpg" />
    </div>
  </div>

  </div>

  

  <!-- Modal -->
  <form action="../services/editHospitalservices.php" method="POST" enctype="multipart/form-data">

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Hospital Details</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">

            <div id="EditHosProfile"></div>


            <div class="row align-items-center pb-3">
              <div class="col-3">
                <h6>Hospital Name</h6>
              </div>
              <div class="col-9">
                <input type="text" name="name" class="form-control" value="<?php echo $bloodBank->getBloodBankName(); ?>" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
              </div>
            </div>
            <div class="row align-items-center pb-3">
              <div class="col-3">
                <h6>contactNumber</h6>
              </div>
              <div class="col-9">
                <input type="text" name="contactNumber" class="form-control" value="<?php echo $bloodBank->getContactNo(); ?>" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
              </div>
            </div>
            <div class="row align-items-center pb-3">
              <div class="col-3">
                <h6>Address</h6>
              </div>
              <div class="col-9">
                <input type="text" name="address" class="form-control" value="<?php echo $bloodBank->getAddress(); ?>" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
              </div>
            </div>

            <div class="row align-items-center pb-3">
              <div class="col-3">
                <h6>District</h6>
              </div>
              <div class="col-9">
                <select name="district" class="form-control form-control-lg" id="district" onchange="functionTest(this.value)">
                  <option><?php echo $Location['district']; ?></option>
                  <?php


                  $dataArray = district::getAllDistrict(); // Retrieve district data using the "getAllDistrict()" method

                  foreach ($dataArray as $district) {
                  ?>

                    <option value="<?php echo $district['district']; ?>"><?php echo $district['district']; ?></option>
                  <?php
                  }
                  ?>
                </select>
              </div>
            </div>

            <div class="row align-items-center pb-3">
              <div class="col-3">
                <h6>Division</h6>
              </div>
              <div class="col-9">


                <select name="division" class="form-control form-control-lg" id="divisionDropDown" onchange="getBloodBank(this.value)">
                  <option><?php echo $Location['division']; ?></option>

                </select>
              </div>
            </div>

            <input type="hidden" name="token" value="<?php echo $token; ?>" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
            <input type="hidden" name="hospitalId" value="<?php echo $hospitalId; ?>" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        </div>
      </div>
    </div>
  </form>
  <?php

  ?>
</body>

</html>