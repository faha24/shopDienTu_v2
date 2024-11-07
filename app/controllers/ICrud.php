<?php 
namespace App\Controllers;

interface ICrud {
      function index();
      function create();
      // function show($id);

      function update();
      function destroy($id);
  
}