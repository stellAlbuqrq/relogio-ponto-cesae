# ⏱️ Sistema de Picagem de Ponto - CESAE Digital

Este projeto foi desenvolvido com **Laravel 12**, utilizando **MySQL (MariaDB)** como base de dados, **Breeze** para autenticação e **Blade** para renderização da interface. O principal objetivo é disponibilizar uma aplicação web para registo da picagem de ponto dos formandos dos cursos do CESAE Digital.

O sistema está dividido por perfis de utilizador, cada um com funcionalidades distintas:
- **Administrador:** Gestão total de cursos, turmas, módulos, formadores e formandos.
- **Formador:** Disparo de PIN para picagem, visualização do cronograma, gestão de presenças e validação de justificações.
- **Formando:** Picagem por PIN (manual e automática), acesso ao histórico de aulas, justificação de faltas, e consulta ao cronograma.

---

## 🚀 Tecnologias Utilizadas

- **Laravel 12** – Framework moderno e robusto em PHP  
- **MySQL (MariaDB)** – Sistema de gestão de bases de dados relacionais  
- **Breeze** – Implementação simples de autenticação  
- **Blade** – Motor de templates do Laravel  
- **Tailwind CSS** – Framework de estilos moderno e responsivo  
- **Bootstrap** – Componentes visuais prontos  
- **PHP Pest** – Framework de testes elegante  
- **JavaScript** – Funcionalidades interativas no frontend  
- **FullCalendar** – Biblioteca de calendário interativo  
- **ApexCharts** – Gráficos interativos e personalizáveis  
- **Spatie Simple Excel** – Importação/exportação de ficheiros CSV/Excel  
- **Git & GitHub** – Controlo de versão e colaboração

---

## 🎯 Funcionalidades

✔ Autenticação e registo para diferentes tipos de utilizadores  
✔ Picagem de ponto com PIN, incluindo picagens tardias e check-out automático  
✔ Gestão completa de cronogramas e presenças  
✔ Submissão e validação de justificações (ex: atestados médicos)  
✔ Exportação/importação de dados em CSV/Excel  
✔ Integração com filas Laravel (`queue:work`) para automatização do check-out  
✔ Base de dados com dados simulados (seeders) para testes

---

## 🔧 Instalação

> **Importante:** Certifica-te que o teu ambiente local (ex: XAMPP) está ativo com MySQL em execução.

```bash
# Clonar o repositório
git clone https://github.com/stellAlbuqrq/relogio-ponto-cesae.git
cd relogio-ponto-cesae

# Instalar as dependências
composer install
npm install

# Copiar ficheiro de ambiente e configurar
cp .env.example .env
php artisan key:generate

# Migrar base de dados
php artisan migrate

# Popular a base de dados com dados iniciais
php artisan db:seed

# (Importante) Importar manualmente o ficheiro cronograma:
# Usar o MySQL Workbench ou semelhante → Import Table Data
# Ficheiro: Data/data_base_cronograma(Folha1).csv

# Atualizar autoload e bibliotecas
composer dump-autoload
composer update

# Criar link para armazenar justificações
php artisan storage:link

# Instalar biblioteca de Excel (se ainda não estiver instalada)
composer require spatie/simple-excel

# (Opcional) Gerar presenças fictícias
php artisan db:seed --class=PresencaSeeder

# (Opcional) Ativar fila para check-out automático
php artisan queue:work

