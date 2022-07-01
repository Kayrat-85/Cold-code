<?php
    include("../../path.php");
    include("../database/connect.php");
    include("../controllers/registrationController.php");
    include("../controllers/topicsController.php");
?>
<?php 
	$topics = getAllTopics();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
            include("../include/head.php");
        ?>
        <title>что такое интернет?|Could-code</title>
    </head>

    <body>
        <!-- Header -->
        <?php
            include("../include/header.php");
        ?>
        <br>
        <!--Блок main - начало-->
        <div class="container">
            <div class="content row">
                <!--Main Content-->
                <div class="main-content col-md-9 col-12">
                    <h2>Что такое интернет?</h2>  
                    <div class="single_post row">
                        <img src="../../Assets/images/1da3b552f7b5413371952c714e08b3ec.jpg" alt="Image" class="img-thumbnail">
                        <div class="info"> 
                            <i class="far fa-user">Admin</i>
                            <i class="far fa-calendar">Mar 11, 2022</i>
                        </div>
                        <div class="post_text col-12">
                            <p>
                                <strong>Интерне́т</strong><em> (англ. Internet)</em> — информационно-коммуникационная сеть и всемирная 
                                система объединённых компьютерных сетей для хранения и передачи информации.
                            </p>
                            <p>
                                Раньше упоминался как Всемирная сеть и Глобальная сеть, а также просто Сеть. 
                                Построена на базе стека протоколов TCP/IP. На основе Интернета работает 
                                Всемирная паутина (World Wide Web, WWW) и множество других систем передачи данных. 
                                К началу 2020 года число пользователей достигло 4,5 млрд человек, что составляет более 50 %
                                от всех жителей планеты Земля. Во многом это было обусловлено широким распространением 
                                сотовых сетей с доступом в Интернет стандартов 3G, 4G и 5G, развитием социальных сетей и 
                                удешевлением стоимости интернет-трафика.
                            </p>
                            <p>
                                Суперуспешное развитие Интернета во многом объясняется также тем, что во второй половине 
                                2010-х годов мировая Сеть фактически стала полномасштабной заменой всем классическим 
                                инструментам получения информации, связи и коммуникации. Все «классические» СМИ — 
                                телевидение, радио и печатные издания — имеют полноценные онлайн-версии, кроме того, 
                                существует безграничное множество интернет-СМИ и блог-платформ, соединяющих все признаки 
                                различных форм коммуникации, делая контент более «живым» и менее зависимым от штампов. 
                                На сегодняшний день самыми популярными интернет-ресурсами являются социальные сети 
                                (Facebook, Instagram, Twitter), мессенджеры (WhatsApp, Viber, Telegram), а также 
                                энциклопедия Википедия и видеохостинг YouTube. Последний часто называют 
                                «новым телевидением», «заменой телевидению» и т. д.
                            </p>
                            <strong>История</strong>
                            <p>
                                Принципы, по которым строится Интернет, впервые были применены в сети ARPANET, 
                                созданной в 1969 году по заказу американского агентства DARPA. Используя наработки ARPANET, 
                                в 1984 году Национальный научный фонд США создал сеть NSFNET для связи между университетами 
                                и вычислительными центрами. В отличие от закрытой ARPANET подключение к NSFNET было 
                                достаточно свободным и к 1992 году к ней подключились более 7500 мелких сетей, включая 
                                2500 за пределами США. С передачей опорной сети NSFNET в коммерческое использование 
                                появился современный Интернет.
                            </p>
                            <strong>Разработка концепции</strong>
                            <p>
                                Первой исследовательской программой в направлении быстрой передачи сообщений руководил 
                                Джозеф Ликлайдер, опубликовавший в 1962 году работу «Galactic Network». Благодаря 
                                Ликлайдеру появилась первая детально разработанная концепция компьютерной сети. 
                                Она была подкреплена работами Леонарда Клейнрока в области теории коммутации пакетов 
                                для передачи данных (1961—1964). В 1962 году Пол Бэран из RAND Corporation подготовил 
                                доклад «On Distributed Communication Networks». Он предложил использовать децентрализованную 
                                систему связанных между собой компьютеров (все компьютеры в сети равноправны), которая даже 
                                при разрушении её части будет работоспособна. Этим решались две важные задачи — 
                                обеспечение работоспособности системы и неуничтожимость данных, которые оказываются 
                                сохранёнными на разнесённых друг от друга компьютерах. Предлагалось передавать сообщения
                                в цифровом, а не в аналоговом виде. Само сообщение предлагалось разбивать на небольшие 
                                порции — «пакеты», и передавать по распределённой сети все пакеты одновременно. 
                                Из принятых в месте назначения дискретных пакетов сообщение заново «собиралось». 
                                В 1967 году Ларри Робертс предложил связать между собой компьютеры ARPA. 
                                Начинается работа над созданием первой интернет-сети ARPANet. Параллельно в Англии 
                                Дональд Дэвис разработал концепцию Сети и добавил в неё существенную деталь — 
                                компьютерные узлы должны не только передавать данные, но и стать переводчиками для 
                                различных компьютерных систем и языков. Именно Дэвису принадлежит термин «пакет» 
                                для обозначения фрагментов файлов, пересылаемых раздельно. Между Калифорнийским 
                                университетом в Лос-Анджелесе, Стэнфордским исследовательским институтом, 
                                Калифорнийским университетом в Санта-Барбаре и университетом штата Юта прокладывается 
                                специальный кабель связи. Группа специалистов Фрэнка Харта из BBN приступила к решению 
                                технических проблем по организации сети ARPANET.
                            </p>
                            <strong>ARPANET</strong>
                            <p>
                                Разработка такой сети была поручена Калифорнийскому университету в Лос-Анджелесе, 
                                Стэнфордскому исследовательскому центру, Университету Юты и Университету штата Калифорния 
                                в Санта-Барбаре. Компьютерная сеть была названа ARPANET (англ. Advanced Research Projects Agency Network), 
                                и в 1969 году в рамках проекта сеть объединила четыре указанных научных учреждения. 
                                Все работы финансировались Министерством обороны США. Затем сеть ARPANET начала активно 
                                расти и развиваться, её начали использовать учёные из разных областей науки.
                            </p>
                            <p>
                                Первый сервер ARPANET был установлен 2 сентября 1969 года в Калифорнийском университете (Лос-Анджелес). 
                                Компьютер Honeywell DDP-516 имел 24 Кб оперативной памяти.
                            </p>
                            <p>
                                29 октября 1969 года в 21:00 между двумя первыми узлами сети ARPANET, находящимися на расстоянии в 640 км — 
                                в Калифорнийском университете Лос-Анджелеса (UCLA) и в Стэнфордском исследовательском институте (SRI) — 
                                провели сеанс связи. Чарли Клайн (Charley Kline) пытался выполнить удалённое подключение из Лос-Анджелеса 
                                к компьютеру в Стэнфорде. Успешную передачу каждого введённого символа его коллега Билл Дювалль (Bill Duvall) 
                                из Стэнфорда подтверждал по телефону.
                            </p>
                            <p>
                                В первый раз удалось отправить всего два символа «LO» (изначально предполагалось передать «LOG») после чего 
                                сеть перестала функционировать. LOG должно было быть словом LOGIN (команда входа в систему). 
                                В рабочее состояние систему вернули уже к 22:30, и следующая попытка оказалась успешной. 
                                Именно эту дату можно считать днём рождения интернета.
                            </p>
                            <p>
                                К 1971 году была разработана первая программа для отправки электронной почты по сети. Эта программа 
                                сразу стала популярна среди пользователей сети.
                            </p>
                            <p>
                                В 1973 году к сети были подключены через трансатлантический телефонный кабель первые иностранные 
                                организации из Великобритании и Норвегии, сеть стала международной.
                            </p>
                            <p>
                                В 1970-х годах сеть в основном использовалась для пересылки электронной почты, тогда же появились 
                                первые списки почтовой рассылки, новостные группы и доски объявлений. Однако в то время сеть ещё не 
                                могла легко взаимодействовать с другими сетями, построенными на других технических стандартах. 
                                К концу 1970-х годов начали бурно развиваться протоколы передачи данных, которые были стандартизированы 
                                в 1982—1983 годах. Активную роль в разработке и стандартизации сетевых протоколов играл Джон Постел. 
                                1 января 1983 года сеть ARPANET перешла с протокола NCP на TCP/IP, который успешно применяется до сих 
                                пор для объединения («наслоения») сетей. Именно в 1983 году термин «интернет» закрепился за сетью ARPANET.
                            </p>
                            <p>
                                В 1984 году была разработана система доменных имён (англ. Domain Name System, DNS).
                            </p>
                        </div>
                    </div>
                    <nav aria-label="...">
                        <ul class="pagination">
                            <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                            </li>
                            <li class="page-item active" aria-current="page">
                                <a class="page-link" href="whatInternet.php">1</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="whatInternet02.php">2 
                                    <span class="sr-only">(current)</span>
                                </a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="whatInternet03.php">3</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="whatInternet02.php">Next</a>
                            </li>
                        </ul>
                    </nav>
                </div>
                <!--Sidebar Content-->
                <?php
                    include("../include/sidebar.php");
                ?>
            </div>
        <!--Блок main - конец-->
        </div>
        <?php
            include("../include/footer.php");
        ?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" 
            integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
        </script>
    </body>
</html>
