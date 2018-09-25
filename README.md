# yii2-lead-kit

### Установка
```
composer require pantera-digital/yii2-lead-kit "@dev"
```
Добавить в консольный конфиг путь до миграций
```
'controllerMap' => [
    'fixture' => [
        'class' => 'yii\console\controllers\FixtureController',
        'namespace' => 'common\fixtures',
    ],
    'migrate' => [
        'class' => yii\console\controllers\MigrateController::className(),
        'migrationPath' => [
            '@pantera/leads/migrations',
        ],
    ],
],
```
Подключить модуль админки
```
'modules' => [
    'leads' => [
        'class' => \pantera\leads\admin\Module::class,
        'permissions' => ['admin'],
    ],
],
```
Подключить модуль для фронта
```
'modules' => [
    'leads' => [
        'class' => pantera\leads\Module::class,
    ],
],
```
### Использование
Модуль предоставляет две подготовленные формы для Обратного звонка и Задать вопрос
* Ключ для формы обратного звонка - callMe
* Ключ для формы задать вопрос - question

Добавление кнопки с формой
```
<?= pantera\leads\widgets\form\LeadForm::widget([
    'key' => 'callMe',
    'text' => 'ЗАКАЗАТЬ ЗВОНОК',
    'options' => [
        'class' => 'btn-call btn',
    ],
]) ?>
``` 
Параметры виджета
* key - Ключ для выбора формы из конфига
* text - Текст кнопки
* options - Массив опций для кнопки
* mode - В каком режите должен отработать видте по умолчанию испоьзуется pantera\leads\widgets\form\LeadForm::MODE_AJAX
  * pantera\leads\widgets\form\LeadForm::MODE_AJAX - Виджет выведит кнопку и разметку для модалки сама форма будет загружена асинхронно 
  * pantera\leads\widgets\form\LeadForm::MODE_DEFAULT - Виджет выведит кнопку и модалку сразу с формой
  * pantera\leads\widgets\form\LeadForm::MODE_INLINE - Виджет выведит саму форму
  
### Конфигурация
Можно добавлять свои формы или переопределить текушие

В конфигурацию фронт модуля нужно добавить параметр config

Пример дефолтный настроек
```
'modules' => [
    'leads' => [
        'class' => pantera\leads\Module::class,
        'config' => [
            'callMe' => [
                'className' => pantera\leads\models\CallMe::class,
                'view' => '@pantera/leads/views/default/call-me',
            ],
            'question' => [
                'className' => pantera\leads\models\Question::class,
                'view' => '@pantera/leads/views/default/question',
            ],
        ],
    ],
],
```
* Параметр className говорит модулю какую модель нужно использовать
* Парметр view указывает на полный путь до файла представления формы