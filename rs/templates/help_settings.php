<?php _e('<br/>При изменение параметров, плагин вам подскажет возможные ошибки в настройках, а так же возможные правильные варианты настроек.


          <br/><br/>Всего у плагина есть 8 параметров, которые нужно установить:<br/>
            <b>Домен, на который выдан ключ</b> <br/>
              <span class="elsagrinner">Тут нужно указать домен, на который вы купили ключ <br/>
              Отсутствие этого параметра не скажется на работоспособности плагина, но вы потеряете ряд важных, по-моему мнению, преимуществ.<br/>
              Более подробно об этом написано в разделе  <a href="#e">Buy key</a></span> <br/>

            <b>Ключ плагина</b> <br/>
              <span class="elsagrinner">Тут нужно указать ключ, который я вам выслал <br/>
              Отсутствие этого параметра не скажется на работоспособности плагина, но вы потеряете ряд важных, по-моему мнению, преимуществ.<br/>
              Более подробно об этом написано в разделе  <a href="#e">Buy key</a></span> <br/>

            <b>Подключать jQuery</b> <br/>
              <span class="elsagrinner">Укажите, нужно ли плагину подключать код jQuery <br/>
              Из за отсутствия этого параметра в предыдущих версиях часто возникали конфликты разных библиотек, т.к. плагин по-умолчанию подключал
              jQuery. В результате начинались непонятные проблемы с сайтом. Сейчас вы сами выбираете подключать или же нет.
              Например если у вас установлен какой либо плагин который уже подключает его то установите этот параметр в "no".
              <br/>Для работы плагина данная библиотека обязательна!

              </span> <br/>


            <b>Папка для загрузок</b> <br/>
              <span class="elsagrinner">Укажите директорию, доступную для записи, куда плагин будет сохранять полученные в результате работы файлы. <br/>
              если в данном параметре используется символ "/", тогда директория будет считаться относительно корневой папки сайта. В противном случае, директория будет искаться относительно директории плагина.

              <br/>Этот параметр необходим для работы плагина, его отсутствие или неправильное значение приведет к невозможности выполнения заданий.

              </span> <br/>


            <b>Url к папке с загрузками</b> <br/>
              <span class="elsagrinner">Урл к папке для загрузок относительно сайта.
              <br/>Этот параметр необходим для работы плагина, его отсутствие или неправильное значение приведет к невозможности выполнения заданий.
              </span> <br/>


            <b>Куда прописывать ссылки на плагин</b> <br/>
              <span class="elsagrinner">Данный параметр управляет возможность устанавливать ссылки на сайт плагина в постах или в футере сайта.
              <br/> Возможные значения:  <br/>
              <ul>
                <li><b>none</b> &mdash; ссылки не ставятся</li>
                <li><b>post</b> &mdash; ссылки ставятся в каждом посте добавленным плагином в конец текста поста</li>
                <li><b>after post</b> &mdash; ссылки ставятся в каждом посте добавленным плагином в конец текста поста</li>
                <li><b>before post</b> &mdash; ссылки ставятся в каждом посте добавленным плагином в начало текста поста</li>
                <li><b>site footer</b> &mdash; ссылка ставятся в футер сайта</li>
               </ul>
              <br />
               Если вы используете данный плагин, но не покупаете его платную версию, пожалуйста, указывайте ссылки на сайт плагина.<br />
               Пример ссылки - it is inserted <a href="http://savitov.ru/ELSAGR/">ElSa</a>
              </span> <br/>


            <b>Язык</b> <br/>
              <span class="elsagrinner">
              Языковые настройки плагина. Сейчас доступны руский и английский языки</span> <br/>


            <b>Set time limit</b> <br/>
              <span class="elsagrinner">
              Задает время в секундах, в течение которого скрипт должен завершить работу. Если скрипт не успевает, вызывается фатальная
              ошибка. По умолчанию дается 30 секунд, либо время, записанное в настройке  max_execution_time
              в php.ini (если такая настройка установлена). При вызове set_time_limit() перезапускает счетчик с нуля.
              Другими словами, если таймаут изначально был 30 секунд, и через 25 секунд после запуска скрипта будет вызвана функция
              set_time_limit(20), то скрипт будет работать максимум 45 секунд.
              <br/>Если задан ноль, время выполнения неограниченно.




              </span> <br/>','ELSAGR');
?>
