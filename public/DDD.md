
app/
├── Domain/
│   ├── Common/                        # Interfaces, tipos comuns, Value Objects genéricos
│   ├── Aluno/
│   │   ├── Entities/
│   │   ├── Repositories/
│   │   ├── Services/
│   │   └── ValueObjects/
│   ├── Formador/
│   │   └── ...
│   ├── Presença/
│   │   ├── Entities/
│   │   ├── Repositories/
│   │   ├── Services/
│   │   └── ValueObjects/
│   ├── Justificacao/
│   │   ├── Entities/
│   │   ├── Repositories/
│   │   ├── Services/
│   │   └── ValueObjects/
│
├── Application/
│   ├── DTOs/
│   ├── UseCases/
│   │   ├── Aluno/
│   │   ├── Formador/
│   │   └── Presença/
│   └── Services/
│
├── Infrastructure/
│   ├── Persistence/
│   │   ├── Eloquent/
│   ├── Auth/
│   ├── FileUpload/
│   └── IpValidator/
│
├── Interfaces/
│   ├── Http/
│   │   ├── Controllers/
│   │   ├── Requests/
│   │   └── Resources/
│   └── Web/
│       └── Views/ (opcional)


*********************************************************************

Domain/ 

├── Common/                         # Tipos genéricos usados em vários domínios (Value Objects, Enums, interfaces comuns)
│
├── Aluno/                          # Domínio específico dos Formandos
│   ├── Entities/                   # Entidades centrais (ex: Formando)
│   ├── Repositories/              # Contratos para repositórios (ex: FormandoRepositoryInterface)
│   ├── Services/                  # Lógica de domínio complexa (ex: regras de picagem do formando)
│   └── ValueObjects/              # Objetos de valor (ex: IPAutorizado, Nome, Email)
│
├── Formador/                       # Domínio dos Formadores (estrutura similar à do Formando)
│   └── ...                         # Mesmos tipos de pastas: Entities, Repositories, Services, ValueObjects
│
├── Presença/                        # Domínio de Picagem de Ponto
│   ├── Entities/                   # Entidade Picagem (ex: Picagem.php)
│   ├── Repositories/              # Contratos de acesso a dados (ex: PicagemRepositoryInterface)
│   ├── Services/                  # Lógica de validação da picagem, verificação de IP
│   └── ValueObjects/              # DataHoraPicagem, IP, etc.
│
├── Justificacao/                  # Domínio das Justificações de Faltas
│   ├── Entities/                   # Entidade Justificacao
│   ├── Repositories/              # Contrato de JustificacaoRepository
│   ├── Services/                  # Validação de anexos, aprovação de justificações
│   └── ValueObjects/              # Comentário, AnexoFicheiro, EstadoJustificacao


Application/

├── DTOs/                           # Objetos de transferência de dados entre camadas (ex: PicagemDTO)
│
├── UseCases/                       # Casos de uso aplicacionais (serviços de aplicação)
│   ├── Aluno/                      # Use cases que envolvem formandos (ex: PicarPontoUseCase)
│   ├── Formador/                   # Use cases do formador (ex: VerPicagensDisciplinaUseCase)
│   └── Presença/                    # Use cases para criar, validar ou listar picagens
│
└── Services/                       # Serviços transversais à aplicação (ex: manipuladores de ficheiros)


Infrastructure/

├── Persistence/                   
│   ├── Eloquent/                  # Models Eloquent (PicagemModel, JustificacaoModel, etc.)
│   │                              # E implementações concretas dos repositórios (ex: EloquentPicagemRepository)
│
├── Auth/                          # Serviços relacionados com autenticação, se precisares personalizar login
│
├── FileUpload/                   # Serviço que lida com upload/download de ficheiros de justificações
│
└── IpValidator/                  # Serviço para validar o IP do formando com a base de dados

Interfaces/

├── Http/
│   ├── Controllers/               # Controladores Laravel (FormandoController, JustificacaoController, etc.)
│   ├── Requests/                  # Form Requests para validação (ex: PicarPontoRequest)
│   └── Resources/                 # Transformers ou API Resources para serializar respostas JSON
│
└── Web/
    └── Views/                     # (Opcional) Se usares Blade para alguma página HTML

