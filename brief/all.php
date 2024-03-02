<?php
if(!(isset($_SESSION['user']))){
    session_start();
}
?>

<div>
    <a href="index.php">Головна</a> 
    <a href="auth.php">Вхід</a> 
    <?php if(isset($_SESSION['user']['role'])): ?>
    <a href="allbriefs.php">Усі брифи</a> 
<?php endif; ?>
</div>

<?php if (isset($_SESSION['user']['role'])) { ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <title>All</title>
</head>
<style>
  /* Стилі для зроблення вигляду як посилання */
  .delete-link {
    color: blue; /* Колір тексту як у посилання */
    text-decoration: underline; /* Підкреслений текст, як у посилання */
    cursor: pointer; /* Зміна форми курсору на вказівник, щоб нагадувати про клікабельність */
  }
</style>
<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">
<div class="main">
    <div class="main__container">
<table border="1">
    <thead>
    <tr>
        <th><input type="text" id="id" name="id" class="filterItems" autocomplete="off" placeholder="id"></th>
        <th><input type="text" id="username" name="username" class="filterItems" autocomplete="off" placeholder="ПІБ клієнта"></th>
        <th><input type="text" id="company_name" name="company_name" class="filterItems" autocomplete="off" placeholder="Назва компанії"></th>
        <th><input type="text" id="phone" name="phone" class="filterItems" autocomplete="off" placeholder="Телефон"></th>
        <th><input type="email" id="email" name="email" class="filterItems" autocomplete="off" placeholder="Email"></th>
        <th><input type="date" id="datepicker" name="date" class="filterItems" autocomplete="off"></th>
        <th><input type="text" id="deadline" name="deadline" class="filterItems" autocomplete="off" placeholder="Місяці"></th>
        <th><input type="text" id="price" name="price" class="filterItems" autocomplete="off" placeholder="Ціна"></th>
        <th><select id="website_type" name="website_type" class="filterItems" autocomplete="off">
            <option value=""></option>
    <option value="blog">Блог</option>
    <option value="portfolio">Сайт-портфоліо</option>
    <option value="ecommerce">Сайт електронної комерції</option>
    <option value="landing_page">Landing Page (Сторінка-вітрина)</option>
    <option value="educational">Освітній/інформаційний портал</option>
    <option value="other">Інше</option>
    <option value="undecided">Я не можу визначитись</option>
</select></th>
<th colspan="3">⭠ Фільтри</th>

    </tr>
    <tr>
        <th>ID</th>
        <th>Клієнт</th>
        <th>Назва компанії</th>
        <th>Контактний телефон</th>
        <th>Email</th>
        <th>Дата</th>
        <th>Термін в місяцях</th>
         <th>Ціна</th>
        <th>Тип сайту</th>
<?php if ($_SESSION['user']['role'] === 'Admin') { ?>
            <th>Видалення</th>
            <th>Оновлення</th>
             <th>PDF</th>
<?php } ?>
    </tr>
    </thead>
    <tbody id="briefValues">
   <?php if ($briefs != null) { ?>
    <?php foreach ($briefs as $el) { ?>
    <tr class="text-center" id="row<?= $el['id'] ?>">
        <td><?php echo $el['id']; ?></td>
        <td><?php echo $el['username']; ?></td>
        <td><?php echo $el['company_name']; ?></td>
        <td><?php echo $el['phone']; ?></td>
        <td><?php echo $el['email']; ?></td>
        <td><?php echo $el['date']; ?></td>
        <td><?php echo $el['deadline']; ?></td>
        <td><?php echo $el['price']; ?></td>
        <td><?php echo $el['website_type']; ?></td>
<?php if ($_SESSION['user']['role'] === 'Admin') { ?>
            <td><a onclick="deleteItem(<?= $el['id'] ?>)" name="delete-btn" class="delete-link">Видалити</a></td>
            <td><a href="/update.php?id=<?php echo $el['id']; ?>">Оновити</a></td>
            <td><a href="/file.php?id=<?php echo $el['id']; ?>">Відкрити</a></td>
<?php } ?>
    </tr>
    <?php } ?>
    <?php } ?>
    </tbody>
</table>
<div class="pages">
    <select id="briefPages" style="width: 55px" class="form-control filterItems" name="page" autocomplete="off">
        <?php for ($i = 0; $i < $count / 10; $i++) { ?>
            <?php if ($i == 0) { ?>
                <option value="1" selected><?php echo $i + 1; ?></option>
            <?php } else { ?>
                <option value="<?php echo $i + 1; ?>"><?php echo $i + 1; ?></option>
            <?php } ?>
        <?php } ?>
    </select>
   
</div>
    </div>
</div>
</body>
</html>
<script>
    const fields = document.getElementsByClassName("filterItems")
    const fieldsInput = document.querySelectorAll("input.filterItems, select.filterItems")
    const briefTable = document.getElementById('briefValues')
    const Pages = document.getElementById('briefPages')


    Array.from(fields).forEach(e => e.addEventListener('input', () => {
        const whereFields = Array.from(fieldsInput)
            .filter(e => e.value !== "")
            .reduce((allEls, el) => ({
                ...allEls,
                [el.name]: el.value,
            }), {});

        let page;
        if (whereFields['page']) {
            page = whereFields['page'];
        }
        delete whereFields['page'];

        let whereString = '';
        if (Object.keys(whereFields).length !== 0) {
            for (const key in whereFields) {
                if (whereString !== "") {
                    whereString += ' AND ';
                }
                if (key === "created_at") {
                    const dateTime = whereFields[key].split('T');
                    whereString += `${key} LIKE '${dateTime[0]} ${dateTime[1]}%'`;
                } else {
                    whereString += `${key} LIKE '${whereFields[key]}%'`;
                }
            }
        }
        if (whereString !== "") {
            whereString = " " + whereString;
        }

        console.log(whereString);

        getSortedBriefs(whereString, page);
    }));

    const getSortedBriefs = (fields, page = 1) => {
        console.log(fields)
        const fieldsNames = ['id', 'username', 'company_name', 'phone', 'email', 'date', 'deadline', 'price', 'website_type'];
        $.ajax({
            url: "https://labipz.000webhostapp.com/controllers/authController.php",
            method: "POST",
            data: {params: fields, page: page},
            success: item => {
                console.log(item)
                const data = JSON.parse(item);


                briefTable.innerHTML = '';

                data['briefs'].forEach(brief => {
                    const row = document.createElement("tr");
                    row.id = `row${brief['id']}`;
                    fieldsNames.forEach(key => {
                        const col = document.createElement("td");
                        col.textContent = brief[key];
                        row.appendChild(col);
                    });

                    if (<?= $_SESSION['user']['role'] == "Admin";?>) {
                        // Видалити
                        const td_del = document.createElement("td");
                        const a_del = document.createElement("a");
                        a_del.setAttribute("onclick", `deleteItem(${brief['id']})`);
                        a_del.textContent = 'Видалити';
                        a_del.classList.add('delete-link');
                        td_del.appendChild(a_del);
                        row.appendChild(td_del);

                        // Оновлення
                        const td_upd = document.createElement("td");
                        const a_upd = document.createElement("a");
                        a_upd.href = `\\update.php?id=${brief['id']}`;
                        a_upd.textContent = 'Оновити';
                        td_upd.appendChild(a_upd);
                        row.appendChild(td_upd);
                        
                         // ПДФ
                        const td_pdf = document.createElement("td");
                        const a_pdf = document.createElement("a");
                        a_pdf.href = `\\file.php?id=${brief['id']}`;
                        a_pdf.textContent = 'PDF';
                        td_pdf.appendChild(a_pdf);
                        row.appendChild(td_pdf);
                   }
                    briefTable.appendChild(row);
                });

                Pages.innerHTML = '';
                console.log(`page = ${page}`);
                for (let j = 0; j < data['countBriefs'] / 10; j++) {
                    const tmp = j + 1;
                    const option = document.createElement("option");
                    option.value = tmp;
                    console.log(`tmp = ${tmp}`);
                    console.log(`page = ${page}`);
                    if (page == tmp) {
                        console.log("selected");
                        option.selected = true;
                    }
                    option.textContent = tmp;
                    Pages.appendChild(option);
                }
            }
        });
    };

    //Асинхронне видалення
    const deleteItem = (id) => {

        $.ajax({
            url: '/controllers/authController.php',
            method: "POST",
            data: {'id': id, 'del': 'del'},
            success: function (item) {
                const data = JSON.parse(item)
                document.getElementById(`row${id}`).remove();
            }
        });
    }
    
   
</script>
<?php } ?>