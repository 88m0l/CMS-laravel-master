<div dir="rtl">

# تطوير موقع إدارة محتوى

### الشيفرة المصدرية لتطبيق موقع إدارة محتوى من دورة "تطوير تطبيقات الويب باستخدام PHP" المقدمة من أكاديمية حسوب

<a href="https://academy.hsoub.com/learn/php-web-application-development/">دورة تطوير تطبيقات الويب باستخدام  PHP</a>

# خطوات تشغيل المشروع

* إنشاء ملف باسم `env.` في المسار الأساسي للمشروع
* تعبئة الملف `env.` بالبيانات، و نستطيع نسخ هذه البيانات من الملف `env.example.` ولصقها بداخل الملف `env.` و التعديل عليها
* تغيير اسم قاعدة البيانات في الملف `env.` باسم مشابه تمامًا لقاعدة البيانات التي أنشأناها
* نهجر الجداول إلى قاعدة البيانات ونعبئها بالمعلومات من `البذور` بتنفيذ الأمر:

<pre dir="ltr">
php artisan migrate --seed
</pre>

* لكي تُعرض الصور في المشروع يجب علينا إنشاء رابط link بتنفيذ الأمر:
<pre dir="ltr">
php artisan storage:link
</pre>

* إنشاء الحزم اللازمة لتشغيل المشروع بتنفيذ الأمر:
<pre dir="ltr">
composer install
</pre>

<pre dir="ltr">

npm install

</pre>
* بعدها ننفذ الأمر:
<pre dir="ltr">
php artisan key:generate
</pre>

* نستخدم في المشروع نظام الإشعارات باستخدام pusher لذلك لضبط إعداداته من ملف `env.`

<pre dir="ltr">
BROADCAST_DRIVER=pusher
PUSHER_APP_ID=
PUSHER_APP_SECRET=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_APP_CLUSTER=
</pre>

* الآن أصبح المشروع جاهز للتشغيل ننفذ الأمر:

<pre dir="ltr">

php artisan serve
</pre>

* ننسخ الرابط الذي ظهر ونلصقه بالمتصفح.

</div>
