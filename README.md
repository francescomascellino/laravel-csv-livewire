<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>


# Creazione di un Seeder tramite file .csv

## 1 Creazione del seeder:

Utilizza il comando Artisan ***make:seeder*** per generare il seeder.
```bash
php artisan make:seeder CategoryTableSeeder
```
## 2 Definizione del seeder:

Apri il file generato ***CategoryTableSeeder.php*** nella ***directory database/seeders***.

Questo file definisce la classe del seeder ***CategoryTableSeeder*** estendendo Seeder.

Il metodo run è il punto di ingresso per eseguire il seeder.
```php
namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class CategoryTableSeeder extends Seeder
{
    public function run()
    {
        // Ottiene il percorso del file CSV nel database
        $csvPath = database_path('csv/categories.csv');

        // Legge il contenuto del file CSV in una stringa
        $categoriesCsv = file_get_contents($csvPath);

        // Converte la stringa CSV in un array di array utilizzando str_getcsv
        $categoriesArray = array_map('str_getcsv', explode("\n", $categoriesCsv));

        // Rimuove la prima riga dell'array (intestazioni)
        array_shift($categoriesArray);

        // Popola la tabella delle categorie
        foreach ($categoriesArray as $categoryData) {
            $category = new Category();
            $category->label = $categoryData[0];
            $category->color = $categoryData[1];
            $category->save();
        }
    }
}
```
### Funzionamento del seeder

#### database_path():
La funzione ***database_path()*** restituisce il percorso completo della directory ***database*** di Laravel.
Viene utilizzata per ottenere il percorso completo del file CSV all'interno della cartella database.

#### file_get_contents():
La funzione ***file_get_contents()*** legge il contenuto di un file in una stringa.
Nel seeder, viene utilizzata per leggere il contenuto del file CSV delle categorie.

#### Parsing dei dati CSV:
La funzione ***array_map()*** applica una funzione a ciascun elemento di un array. In questo caso, viene utilizzata per applicare la funzione ***str_getcsv()*** a ciascuna riga del CSV elaborata con ***explode("\n", $categoriesCsv)***.

La stringa CSV viene suddivisa in righe utilizzando ***explode("\n", $categoriesCsv)***, che restituisce un array di righe del CSV. La sequenza di escape ***\n*** è un carattere speciale utilizzato nelle stringhe per rappresentare un "a capo" o una nuova riga. Quando usata con la funzione ***explode()***, che spezza una stringa in un array utilizzando un delimitatore specificato, ***"\n"*** indica di dividere il contenuto del file CSV in righe separate, poiché ogni riga termina con un carattere di nuova riga.

Ogni riga del CSV viene quindi convertita in un array associativo utilizzando ***str_getcsv()***, che analizza la riga CSV in un array di campi (https://www.php.net/manual/en/function.str-getcsv.php).

Da categories.csv:
```
"label","color"
"Apollo","#d05db8"
"Atena","#ed5982"
"Efesto","#ff8767"
"Era","#ffbf59"
"Zeus","#f9f871"
```
Otterremo il seguente array (***$categoriesArray***):
```js
[
    ["label", "color"],
    ["Apollo", "#d05db8"],
    ["Atena", "#ed5982"],
    ["Efesto", "#ff8767"],
    ["Era", "#ffbf59"],
    ["Zeus", "#f9f871"],
]
```

#### Popolamento della tabella delle categorie:
Dopo aver ottenuto i dati dal CSV e convertito in un array utilizzabile, il seeder itera su ciascuna riga per creare e salvare una nuova istanza del modello Category.

I valori della categoria e del colore vengono assegnati dalla riga corrente del CSV e salvati nel database.

## 3 Esecuzione del seeder
Utilizza il comando Artisan ***db:seed*** per eseguire il seeder.
```bash
php artisan db:seed --class=CategoryTableSeeder
```

<hr>

# Guida all'utilizzo di Livewire in Laravel

Livewire è una libreria che semplifica lo sviluppo di interfacce utente interattive in Laravel utilizzando PHP. Questa guida ti condurrà attraverso i passaggi per installare e utilizzare Livewire nel tuo progetto Laravel.

## 1. Installazione di Livewire

Per installare Livewire nel tuo progetto Laravel, esegui i seguenti comandi nel terminale:
```bash
composer require livewire/livewire
```

Questo comando pubblicherà le risorse di Livewire nel tuo progetto:
```bash
php artisan livewire:publish --assets
```
## 2. Creazione di un componente Livewire

Per creare un nuovo componente Livewire, esegui il seguente comando Artisan:
```bash
php artisan make:livewire ProductCardComponent
```

Questo creerà un nuovo componente Livewire chiamato ***CardComponent*** nella directory ***app/Http/Livewire*** e una vista chiamata card-component.blade.php nella directory ***resources/views/livewire***.

## 3. Implementazione del componente Livewire

Modifica il file ***app/Http/Livewire/ProductCardComponent.php*** per includere la logica del componente:
```php
namespace App\Livewire;

use Livewire\Component;

class ProductCardComponent extends Component
{
    public $product;

    public function mount($product)
    {
        $this->product = $product;
    }

    public function render()
    {
        return view('livewire.product-card-component', [
            'product' => $this->product
        ]);
    }
}
```

### Funzionamento di ***mount*** e ***render***

#### Metodo ***mount($product)***:
Il metodo mount viene chiamato quando il componente viene inizializzato.
Accetta un parametro ***$product*** che rappresenta il prodotto passato al componente.
All'interno del metodo ***mount***, il prodotto viene assegnato alla variabile ***$product***.

#### Metodo ***render()***:
Il metodo ***render*** è responsabile della visualizzazione del componente.
Restituisce la vista ***livewire.product-card-component*** passando i dati del prodotto al template.
In questo caso, il prodotto viene passato come variabile ***$product***.

## 4. Creazione della vista Livewire

Crea la tua vista Livewire in ***resources/views/livewire/product-card-component.blade.php*** e utilizza le variabili fornite dal componente per visualizzare i dati:
```html
<div class="col-2">
    <div class="card bg-dark text-light shadow h-100">
        <img src="{{ $product['image'] }}" class="card-img-top" alt="...">
        <div class="card-body">
            <div class="d-flex align-items-center mb-1" style="height: 3rem">
                <h5 class="card-title">{{ $product['name'] }}</h5>
            </div>
            <h6 class="card-subtitle mb-2" style="color: {{ $product['category']['color'] }}">
                {{ $product['category']['label'] }}
            </h6>
            <p class="card-text">{{ $product['description'] }}</p>
        </div>
    </div>
</div>
```

## 5 Renderizzazione del componente in pagina

Apri il file di vista desiderato (ad esempio ***index.blade.php***) dove vuoi renderizzare il componente.

Utilizza la direttiva ***livewire*** per includere il componente Livewire nella vista.

Passa i dati dei prodotti al componente utilizzando la sintassi ***:product="$featuredProduct"***.

```php
@extends('layouts.app')

@section('content')
    <div class="container mx-auto">
        <h1 class="text-center">PRODUCTS INDEX</h1>

        <div class="row justify-content-center g-1">
            @foreach ($featured as $featuredProduct)
                <livewire:product-card-component :product="$featuredProduct" />
            @endforeach
        </div>
    </div>
@endsection
```
## 6 Funzionamento di Livewire e del controller

### Funzionamento del controller:
Nel controller ***ProductController***, nella funzione ***index()***, vengono recuperati i prodotti e i prodotti in primo piano.

Questi dati vengono quindi passati alla vista ***products.index*** utilizzando la funzione ***compact()***.
```php
namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->get();
        $featured = Product::where('featured', true)->get();

        return view('products.index', compact('products', 'featured'));
    }
}
```

In questo modo, hai creato, renderizzato e utilizzato correttamente il componente ***ProductCardComponent*** in una pagina web utilizzando Livewire.