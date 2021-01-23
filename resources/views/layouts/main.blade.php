<!DOCTYPE html>
<html lang="pl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Koło Łowieckie Nr. 87 „Hubertus” w Nowem</title>
  <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" />
  <script src="{{ asset('js/app.js') }}" charset="utf-8"></script>
</head>
<body>
  <div class="bgc-green">
      <header class="header">
        <img src="{{ asset('images/home/wizualizacja_2.jpg') }}" alt="herb zwiazku lowieckiego" />
        <h1>Koło Łowieckie Nr. 87 „Hubertus” w Nowem</h1>
        <img src="{{ asset('images/home/kolo lowieckie w nowem.png') }}" alt="Kolo Łowieckie w Nowem" />
      </header>

      <ul class="top-links ul">
        <li class="li"><a href="/adres" class="link">Ważne dane i adresy</a></li>
        <li class="li"><a href="/dziczyzna" class="link">Sprzedaż dziczyzny</a></li>
        <li class="li"><a href="/galerie" class="link">Foto Galeria</a></li>
        <li class="li"><a href="/galerie-mysliwego" class="link">Foto Galeria dla Myśliwego</a></li>

        @if(Auth::check())
          <li class="li">
            Zalogowany jako <span class="user-name">{{ Auth::user()->name }}</span>
            [<form method="POST" action="{{ route('logout') }}" style="display: inline;">
              @csrf
              <button type="submit">Wyloguj</button>
            </form>]
          </li>
        @else
          <li class="li"><a class="link" href="/login">Panel Myśliwego</a></li>
        @endif
      </ul>

      <main class="main">
        <aside class="aside-left">
          <nav class="nav">
            <ul class="ul">
              <li class="li">
                <a class="link" href="/">Strona Główna</a>
              </li>
              <li class="li">
                <a class="link" href="/historia">Historia Koła</a>
              </li>
              <!-- po kliknięciu w komunikaty otwiera się podstrona, gdzie są informacje które mogą wpisywać i usuwać upoważnione osoby np. -->
              <!-- np http://www.gdansk.pzlow.pl/palio/html.run?_Instance=pzl_www&_PageID=131&_RowID=2021&_CAT=GDANSK.AKTUALNOSCI -->
              <li class="li">
                <a class="link" href="/komunikaty">Komunikaty <br> [po zalogowaniu]</a>
              </li>
              <li class="li">
                <a class="link" href="/zarzad">Zarząd Koła</a>
              </li>
              <li class="li">
                <!-- hasło -->
                <a class="link" href="/czlonkowie_kola">Członkowie</a>
              </li>
              <li class="li">
                <a class="link" href="sztandar">Sztandar</a>
              </li>
              <li class="li">
                <a class="link" href="/odznaczenia">Odznaczenia</a>
              </li>
              <li class="li">

                <!-- baza -->
                <!-- długi tkst i zdjęćia i pod każdyn zdjęciem ma być opis -->

                <a class="link" href="/ostoja">Ostoja</a>
              </li>
              <li class="li">
                <a class="link" href="/trofea">Trofea Łowieckie</a>
              </li>
              <li class="li">
                <a class="link" href="lowiska">Łowiska</a>
              </li>
              <li class="li">
                <!-- zdjęcie i opis pod zdjęćiem -->
                <a class="link" href="/psy">Nasze psy</a>
              </li>
              <li class="li">
                <a class="link" href="/imprezy">Myśliwi dla Was</a>
              </li>
              <li class="li">
                <a class="link" href="/aktualnosci">Aktualności</a>
              </li>
              <li class="li">
                <a class="link" href="https://www.pzlow.pl/asf" target="_blank">Bioasekuracja</a>
              </li>
            </ul>
          </nav>

          <a class="link" href="/kraina">
            <img src="{{ asset('images/aside-left/Świeto-zmarłych.jpg') }}" alt="Gdy wybije mejśmierci godzina, pochowajcie mnie w kniei zielonej niech nade mnązaszumi gęstwina hymn myśliwski radości minionej... - Julian Ejsmond \"Pieśń myśliwska\" (fragment)" />
            <p>Kraina Wiecznych Łowów</p>
          </a>
      </aside>

      <div class="wrapper flex-column-5">@yield('content')</div>

      <aside class="aside-right">
        <a target="_blank" class="link" href="https://www.pzlow.pl/">
          <figure>
            <img src="{{ asset('images/aside-right/PZL.jpg') }}" alt="PZŁ Zarząd Główny" />
            <figcaption>PZŁ Zarząd główny</figcaption>
          </figure>
        </a>

        <a target="_blank" class="link" href="https://www.pzlbydgoszcz.pl/">
          <figure>
            <img src="{{ asset('images/aside-right/LOGO LB_1.jpg') }}" alt="PZŁ - Łowiectwo Bydgoskie - Zarząd Okręgowy" />
            <figcaption>ZO Bydgoszcz</figcaption>
          </figure>
        </a>

        <a target="_blank" class="link" href="https://www.pzltorun.pl/">
          <figure>
            <img src="{{ asset('images/aside-right/pzł toruń.jpg') }}" alt="PZŁ Toruń - Zarząd Okręgowy" />
            <figcaption>ZO Toruń</figcaption>
          </figure>
        </a>

        <a target="_blank" class="link" href=" http://www.gdansk.pzlow.pl/">
          <figure>
            <img src="{{ asset('images/aside-right/PZL.jpg') }}" alt="Zarząd Okręgowy Gdańsk" />
            <figcaption>ZO Gdańsk</figcaption>
          </figure>
        </a>
      </aside>
    </main>

    <footer class="footer">
      <img src="{{ asset('images/home/grafika.png') }}" alt="pole zboża" class="footer-img" />
      <a class="footer-link link-one" href="mailto:kl87@pzlbydgoszcz.pl">
        <img src="{{ asset('images/home/indeks 1.png') }}" alt="mail koła łowieckiego" />
      </a>
      <a href="https://www.facebook.com/Ko%C5%82o-%C5%81owieckie-nr-87-Hubertus-w-Nowem-478568449621517" class="footer-link link-two" target="_blank">
        <img src="{{ asset('images/home/indeks.png') }}" alt="link do konta facebook koła" />
      </a>

      <p class="footer-text">
        "Oświadczamy, że wszystkie treści zawarte na tej stronie internetowej są własnością Koła Łowieckiego Koła Łowieckiego "HUBERTUS" w Nowem i cała zawartość strony internetowej www jest chroniona przez polskie prawo autorskie oraz prawo własności
        intelektualnej. Wszystkie logotypy, nazwy własne, teksty, fotografie, formularze, kody źródłowe, hasła, znaki towarowe, są znakami zastrzeżonymi i należą do Administratora. Pobieranie, kopiowanie, modyfikowanie, reprodukowanie, przesyłanie lub
        dystrybuowanie jakichkolwiek treści ze strony www. bez zgody właściciela jest zabronione"
      </p>
    </footer>
  </div>
</body>
</html>
