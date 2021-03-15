надо запустить php artisan migrate и php artisan DB:seed, 

для авторизации использвал laravel passport ,

если надо будет, должны выполнить команду php artisan passport:install,
 и в енв поставить id и ключ.
Потом после логина надо отправить полученный токен с каждым запросом.
key Authorization
value Bearer "token"

post- baseUrl/login   login user

post- baseUrl/register  register user

get- baseUrl/categories-all   get all categories

get- baseUrl/products  get all products, filter->category_ids,price,characteristic->name

get- baseUrl/product/{slug} get product by slug

post- baseUrl/cart/add/{id}   add product in cart

post- baseUrl/cart/plus/{id}  plus count product

post- baseUrl/cart/minus/{id} minus count product

delete- baseUrl/cart/remove/{id}  delete product by id in cart

post- baseUrl/cart/save-order     save order

resource-    /characteristics   add edit delete characteristic

get- baseUrl/ orders    get all orders in auth user
    
get  baseUrl /logout

