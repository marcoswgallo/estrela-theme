# Estrela Theme

Tema WordPress customizado da **A∴R∴L∴S∴ Estrela de Ribeirão Preto Nº 3132**,
filiada ao Grande Oriente do Brasil.

Site institucional com área pública (história, administração, notícias,
contato) e uma **Área do Obreiro** restrita a membros logados.

> Conceito visual: **"Templo de Pedra e Ouro"** — tipografia lapidar, azul-noite
> profundo, ouro metálico e a estrela flamejante como leitmotiv.

---

## Sumário

- [Identidade visual (Design System)](#identidade-visual-design-system)
- [Estrutura de arquivos](#estrutura-de-arquivos)
- [Componentes e helpers](#componentes-e-helpers)
- [Área do Obreiro (acesso restrito)](#área-do-obreiro-acesso-restrito)
- [Como editar o que muda com frequência](#como-editar-o-que-muda-com-frequência)
- [Dependências externas](#dependências-externas)
- [Preview local](#preview-local)
- [Histórico de mudanças](#histórico-de-mudanças)
- [Ideias / pendências futuras](#ideias--pendências-futuras)

---

## Identidade visual (Design System)

Todas as variáveis ficam no `:root` em [`style.css`](style.css).

### Cores

| Variável | Hex | Uso |
|---|---|---|
| `--primary-blue` | `#0a2c52` | Azul institucional (botões, títulos, painéis) |
| `--blue-night` | `#06192f` | Azul-noite (heros, footer, gradientes) |
| `--blue-deep` | `#041220` | Quase preto azulado (base de gradientes) |
| `--accent-gold` | `#c9a24b` | Ouro de destaque (filetes, ícones, links hover) |
| `--accent-gold-hover` | `#e0bd6a` | Ouro mais claro (estados hover) |
| `--gold-soft` | `#d9c188` | Ouro suave (divisores em fundo escuro) |
| `--gold-gradient` | `linear-gradient(135deg, #b8860b, #e8cd86, #f7e7b6, #b8860b)` | Ouro **metálico** (botão dourado, bordas, underline do menu) |
| `--bg-ivory` | `#f7f3e9` | Fundo principal (pergaminho quente) |
| `--light-bg` | `#efe9da` | Fundo de seções internas |
| `--paper-line` | `#e4dcc8` | Bordas/linhas sutis sobre pergaminho |
| `--text-anthracite` / `--text-color` | `#1f2733` | Texto de corpo (antracite azulado) |
| `--text-light` | `#6b6452` | Texto secundário |

### Tipografia

| Variável | Família | Uso |
|---|---|---|
| `--font-heading` | **Cinzel** (serif lapidar) | Títulos, logo, banners — evoca inscrição em pedra |
| `--font-body` | **EB Garamond** (serif clássica) | Corpo de texto |
| `--font-eyebrow` | **Montserrat** (sans-serif) | Rótulos, botões, menu, eyebrows em caixa alta |

Fontes carregadas via Google Fonts no enqueue de [`functions.php`](functions.php).

### Layout / tokens

- `--section-padding: 7rem 0`
- `--container-width: 1200px`
- `--radius: 2px` (cantos sóbrios/lapidares — padronizado em todo o tema)

### Atmosfera

O `body` recebe duas camadas fixas (`::before` e `::after`): um leve halo de
luz dourada/azul e uma textura de grão sutil (SVG noise inline), dando
profundidade ao fundo pergaminho. Respeita `prefers-reduced-motion`.

---

## Estrutura de arquivos

| Arquivo | Papel | Template Name (no WP) |
|---|---|---|
| [`style.css`](style.css) | Folha de estilo + cabeçalho do tema | — |
| [`functions.php`](functions.php) | Setup, enqueue, área restrita, helpers | — |
| [`header.php`](header.php) | Header fixo com logo, menu e CTA | — |
| [`footer.php`](footer.php) | Footer + portal de login + scripts JS | — |
| [`front-page.php`](front-page.php) | Home (hero, história, notícias) | *Página Inicial Estrela* |
| [`home.php`](home.php) | Listagem do blog (página de posts) | — |
| [`page.php`](page.php) | Páginas internas genéricas | — |
| [`page-administracao.php`](page-administracao.php) | Diretoria (cards + tabela) | *Administração* |
| [`page-contato.php`](page-contato.php) | Contato (info + formulário) | *Contato* |
| [`page-area-do-obreiro.php`](page-area-do-obreiro.php) | Painel de membros | *Área do Obreiro* |
| [`single.php`](single.php) | Post individual (notícias e conteúdo interno) | — |
| [`404.php`](404.php) | Página de erro / não encontrado | — |
| [`index.php`](index.php) | Fallback genérico do WordPress | — |
| `assets/images/` | Logo, joias dos cargos, imagens de hero/blog | — |

---

## Componentes e helpers

Definidos em [`functions.php`](functions.php):

### `estrela_star_svg( $class = '' )`
Retorna o SVG da **estrela flamejante de 5 pontas** (leitmotiv da marca).
Passe classes extras para posicionar/dimensionar.

```php
echo estrela_star_svg( 'hero-star' );
```

### `estrela_divider( $light = false )`
Imprime um **divisor ornamental**: filete dourado — estrela — filete dourado.
Use `true` em fundos escuros.

```php
<?php estrela_divider(); ?>
```

### Classes CSS úteis
- `.reveal` (+ `.delay-1`/`.delay-2`/`.delay-3`) — animação de revelar ao rolar
  (ativada por IntersectionObserver no footer; some com `prefers-reduced-motion`).
- `.ornament-divider` / `.estrela-star` — base dos elementos decorativos.
- `.section-subtitle` (eyebrow), `.section-title`, `.btn-gold`, `.btn-primary`,
  `.btn-text`, `.btn-outline-dark`.
- `.screen-reader-text` — acessibilidade (padrão WordPress).

---

## Área do Obreiro (acesso restrito)

Lógica em [`functions.php`](functions.php).

- **Role personalizada:** `obreiro` (capacidade apenas `read`). Registrada em
  `after_switch_theme` (na ativação do tema).
- **Categorias internas restritas** (`ESTRELA_RESTRICTED_CATS`):
  `avisos`, `atas`, `escalas`, `documentos`.
- **Páginas protegidas** (exigem login): slugs `area-do-obreiro` e
  `painel-do-obreiro`.
- Visitantes não logados são **redirecionados ao login** ao tentar acessar a
  área ou um post de categoria restrita.
- As categorias restritas são **excluídas de todas as listagens públicas**
  (home, blog, busca, RSS) via `pre_get_posts` — só aparecem para logados.
- Após o login, um `obreiro` é redirecionado para `/area-do-obreiro/`.

O painel ([`page-area-do-obreiro.php`](page-area-do-obreiro.php)) exibe 4 módulos
em cards, cada um puxando os últimos posts de uma categoria: **Quadro de Avisos**,
**Atas das Sessões**, **Escalas e Cargos**, **Documentos Fraternas**.

---

## Como editar o que muda com frequência

### Trocar a diretoria (Administração)
Edite **um único array** no topo de
[`page-administracao.php`](page-administracao.php) — os cards **e** a tabela são
gerados a partir dele:

```php
$estrela_officers = array(
    array( 'name' => 'Fulano de Tal', 'role' => 'Venerável Mestre', 'jewel' => 'veneravel.png', 'vem' => true ),
    // ...
);
```
`jewel` = nome do arquivo em `assets/images/`. `vem => true` aplica o destaque
dourado (use só no Venerável Mestre).

**Diretoria atual (gestão registrada):**
| Nome | Cargo |
|---|---|
| Jeferson Alves Moraes | Venerável Mestre |
| Nelson Luiz Palomino | 1º Vigilante |
| Christian Harley Douglas Moro | 2º Vigilante |
| Euripedes Sergio Bredariol | Orador |
| Edson Luis Soares | Secretário |
| Marcos Rodrigo Sciarreta Segato | Tesoureiro |
| Marcos Wesley Gallo | Chanceler |

### Trocar o logo
Use **Aparência → Personalizar → Identidade do site → Logotipo**. O tema usa
`custom-logo` com fallback para `assets/images/logo.png`. Aplica-se ao header e
ao footer automaticamente.

### Data de fundação no header
Texto fixo em [`header.php`](header.php): *"Fundada em 01 de Setembro de 2025"*.

### Dados de contato
Em [`page-contato.php`](page-contato.php):
- E-mail: `secretaria@estreladeribeiraopreto.com.br`
- Endereço: R. Francisca Massaro Farinha, 385/399 — Ribeirânia, Ribeirão Preto/SP, 14096-460
- Mapa: iframe do Google Maps embutido.

### Formulário de contato
A página renderiza um formulário visual de fallback, mas se você inserir o
**shortcode de um plugin** (WPForms / Contact Form 7) no editor da página, ele
assume o lugar. Os estilos do WPForms já estão sobrescritos no `style.css`.

---

## Dependências externas

- **Google Fonts** — Cinzel, EB Garamond, Montserrat (com `preconnect`).
- **Feather Icons** — `unpkg.com/feather-icons@4.29.2` (versão fixa).
- **The Events Calendar** (plugin) — calendário em `/eventos/`; estilos já
  sobrescritos para a paleta do tema.
- **WPForms / Contact Form 7** (opcional) — formulário de contato.

---

## Preview local

Existe um `preview.html` na **pasta-pai do repositório** (fora do tema, não
versionado) que reproduz o markup real carregando o `style.css` de verdade —
útil para validar o visual no navegador sem subir o WordPress. Abra com duplo
clique ou `open ../preview.html` no macOS.

---

## Histórico de mudanças

### Fase 3 — Ajuste do mosaico
- Removida a faixa de **pavimento mosaico**: como filete fino horizontal não
  lia bem (aparência "fita quebrada"). O divisor com estrela faz a transição.

### Fase 2 — Redesign visual "Templo de Pedra e Ouro"
- **Tipografia:** Cinzel + EB Garamond no lugar de Montserrat/Roboto; Montserrat
  ficou só em rótulos/eyebrows.
- **Paleta:** ouro real com gradiente metálico, azuis-noite, fundo pergaminho;
  atmosfera de fundo (halo + grão); cantos sóbrios (`--radius: 2px`).
- **Estrela flamejante** como leitmotiv (helpers `estrela_star_svg` /
  `estrela_divider`): hero, divisores e marca.
- Hero dramático com vinheta, filete dourado e estrela monumental ao fundo.
- Filetes dourados nos cards, citação ornamentada no card do Venerável,
  underline dourado animado no menu, reveal on scroll (com `prefers-reduced-motion`).

### Fase 1 — Correções e boas práticas
- **Bugs CSS:** variáveis ausentes (`--light-bg`, `--text-color`),
  `.screen-reader-text`, `.mb-3`, `.title-sm`; remoção de CSS/JS morto
  (`.impact-counters`, `.header-topbar`, animador de contadores).
- **`functions.php`:** remoção de fontes não usadas, versão fixa do Feather,
  `load_theme_textdomain`, `custom-logo`, `html5`, `responsive-embeds`,
  `preconnect`; role `obreiro` movida para `after_switch_theme`.
- **`header.php`/`footer.php`:** logo via Personalizador com fallback; `wp_date()`.
- **`page-administracao.php`:** diretoria a partir de array único (fim da
  duplicação cards × tabela).
- **Escaping:** `esc_url` nos links da Área do Obreiro e no thumbnail;
  `rel="noopener noreferrer"` nos documentos.
- **Novos templates:** `single.php` e `404.php`.

---

## Ideias / pendências futuras

- [ ] Trocar `logo.png` por uma versão em alta resolução da estrela, alinhada à
      nova identidade.
- [ ] Aplicar os ornamentos (divisor + reveal) também nas páginas **Contato** e
      **Área do Obreiro** para coesão total.
- [ ] Reconsiderar o **pavimento mosaico** em escala maior (textura de fundo de
      uma seção, ou bloco 8×8 real) — nunca como filete fino.
- [ ] Validar `php -l` / testar no WordPress real (front-page, administração e
      o novo `single.php`).
- [ ] Self-host do Feather Icons (remover dependência de CDN externo).
- [ ] Considerar transformar a diretoria e os módulos da Área do Obreiro em
      CPT/ACF se a manutenção crescer.
