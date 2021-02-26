@extends('layouts.main')
@section('content')
<div id="layoutSidenav_content">
   <main>
      <div class="container-fluid">
         <h1 class="mt-4">SQL-запросы</h1>
         <div class="row">
            <div class="col-xl-12">
               <div class="card mb-4">
                  <div class="card-header">
                     <i class="fas fa-chart-area mr-1"></i>
                     Задание 1
                  </div>
                  <div class="card-body">
                     <p>
                        1. Написать SQL-запрос, возвращающий название фирмы и ее телефон. В результате
                        должны быть представлены все фирмы по одному разу. Если у фирмы нет телефона,
                        нужно вернуть пробел или прочерк. Если у фирмы несколько телефонов, нужно
                        вернуть любой из них.
                     </p>
                     <p>
                        Исходные данные:
                     </p>
                     <p>
                        Таблица Firms:
                        ID Name
                        1 Sony
                        2 Panasonic
                        3 Samsung
                     </p>
                     <p>
                        Таблица Phones:
                        phone_id FirmID Phone
                        1 1 332-55-56
                        2 1 332-50-01
                        3 2 256-39-11
                     <p>
                        Для представленного примера запрос должен вернуть:
                        Name Phone
                        Sony 332-55-56
                        Panasonic 256-39-11
                        Samsung
                     </p>
                     </p>
                     <br>
                     <p>
                        Ответ:
                     </p>
                     <p>
                        <b>
                        SELECT firms.name, IF( phones.phone IS NULL, '-',phones.phone )  AS `phone`
                        FROM firms
                        LEFT JOIN phones ON firms.id = phones.firm_id 
                        </b>
                     </p>
                  </div>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-xl-4">
               <div class="card mb-4">
                  <img src="/assets/img/firms.png">
               </div>
            </div>
            <div class="col-xl-4">
               <div class="card mb-4">
                  <img src="/assets/img/phones.png">
               </div>
            </div>
            <div class="col-xl-4">
               <div class="card mb-4">
                  <img src="/assets/img/joined_by_phone.png">
               </div>
            </div>
         </div>
      </div>

      <div class="container-fluid">
         <div class="row">
            <div class="col-xl-12">
               <div class="card mb-4">
                  <div class="card-header">
                     <i class="fas fa-chart-area mr-1"></i>
                     Дополнительные задания:
                  </div>
                  <div class="card-body">
                     <p>
                     a. Вернуть все фирмы, не имеющие телефонов.
                     </p>
                     <p>
                     b. Вернуть все фирмы, имеющие не менее 2-х телефонов..
                     </p>
                     <p>
                     c. Вернуть все фирмы, имеюшие менее 2-х телефонов.
                     </p>
                     <p>
                     d. Вернуть фирму, имеющую максимальное кол-во телефонов.
                     </p>
                     <br>
                     <p>
                        Дополнительно:
                     </p>
                     <p>
                        <b>
                        a) SELECT firms.id, firms.name, phones.phone
FROM firms
LEFT JOIN phones ON firms.id = phones.firm_id 
WHERE phones.phone IS NULL 
                        </b>
                     </p>
                     <p>                        <b>
                        b) SELECT firms.id, firms.name, COUNT(phones.firm_id) AS `number_amount`
FROM phones 
JOIN firms ON phones.firm_id = firms.id
GROUP BY phones.firm_id
HAVING COUNT(phones.firm_id) >= 2
                        </b></p>
                        <p>                        <b>
                        c) SELECT firms.id, firms.name, COUNT(phones.firm_id) AS `number_amount`
FROM phones 
JOIN firms ON phones.firm_id = firms.id
GROUP BY phones.firm_id
HAVING COUNT(phones.firm_id) < 2

                        </b></p>
                        <p>                        <b>
                        d) SELECT firms.id, firms.name, COUNT(phones.phone) AS `phones`
FROM phones 
JOIN firms ON phones.firm_id = firms.id
GROUP BY phones.firm_id
ORDER BY COUNT(phones.firm_id) DESC
LIMIT 1

                        </b></p>
                        
                  </div>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-xl-3">
               <div class="card mb-4">
                  <img src="/assets/img/without_numbers.png">
               </div>
            </div>
            <div class="col-xl-3">
               <div class="card mb-4">
                  <img src="/assets/img/b.png">
               </div>
            </div>
            <div class="col-xl-3">
               <div class="card mb-4">
                  <img src="/assets/img/c.png">
               </div>
            </div>
            <div class="col-xl-3">
               <div class="card mb-4">
                  <img src="/assets/img/d.png">
               </div>
            </div>
         </div>
      </div>
   </main>
</div>
@endsection