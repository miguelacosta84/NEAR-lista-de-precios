# NEAR lista de precios

> Creación de listas de artículos, precios y tienda de compra basado en protocolo NEAR, se compone de un servicio backend hecho en NodeJS que interactúa con el protocolo NEAR mediante la libreria NEAR-API-JS, de esa manera se ofrece un REST API sencillo. Se integra ademas un frontend basado en Laravel que opera con los endpoints del backend para la creación y eliminación de artículos, precios y tiendas de compra en el blockchain de NEAR.

###### Demo:
* [REST API Backend con conectividad al NEAR Testnet y Laravel Frontend](https://nearpricelist.tk) 

---

## Descripcion General

| Ruta                                      | Metodo | Descripcion                                                                                                                 |
| ------------------------------------------ | ------ | --------------------------------------------------------------------------------------------------------------------------- |
| [`/deploy`](#deploy)                       | POST   | Despliega un Contrato en NEAR.                                                     
| [`/addProduct`](#addProduct)                           | POST   | Agrega un producto al listado en el storage del blockchain                                                    |
| [`/getAllProducts`](#getAllProducts)             | POST   | Obtiene un listado de productos almacenados en el storage del blockchain |
| [`/getAllProductsByListId`](#getAllProductsByListId) | POST   | Obtiene un listado de productos ordenados por categoria almacenados en el storage del blockchain.                                                              |
| [`/getProduct`](#getProduct)                     | POST    | Obtiene un producto por id almacenado en el storage del blockchain.                                                                                                   |
| [`/deleteProduct`](#deleteProduct)                     | POST    | Elimina un producto del listado almacenado en el storage del blockchain.                                                                                                 |                                          |

---

## Requisitos

- [Cuenta NEAR](https://docs.near.org/docs/develop/basics/create-account) _(Con acceso a llave privada o frase)_
- [Node.js](https://nodejs.org/en/download/package-manager/)
- [npm](https://www.npmjs.com/get-npm) o [Yarn](https://yarnpkg.com/getting-started/install)
- Herramienta API como Postman [Postman](https://www.postman.com/downloads/)

---

## Configuración

1. Clonar repositorio

```bash
git clone git@github.com:miguelacosta84/NEAR-lista-de-precios.git
```

2. Instalar dependencias

```bash
npm install
```

3. Configurar `near-api-server.config.json`

Configuracion default:

```json
{
  "server_host": "localhost",
  "server_port": 3000,
  "rpc_node": "https://rpc.testnet.near.org",
  "init_disabled": true
}
```

_**Note:** `init_disabled` no es utilizado

4. Iniciar Servidor

```bash
node app
```

---

# CONTRATOS

## `/deploy`

> _Despliega un Contrato en la red blockchain de NEAR basado en el archivo WASM de la carpeta  `/contracts` ._

**Method:** **`POST`**

| Param                            | Description                                                                          |
| -------------------------------- | ------------------------------------------------------------------------------------ |
| `account_id`                     | _Cuenta sobre la que se desplegara el contrato._                             |
| `seed_phrase` _OR_ `private_key` | _Seed phrase O private key del id de la cuenta indicada en `account_id`._                                |
| `contract`                       | _Archivo WASM ubicado en la carpeta `/contracts` resultante de compilar el contrato del proyecto._ |

Ejemplo:

```json
{
  "account_id": "dev-1636081698178-54540899156051",
  "seed_phrase": "witch collapse practice feed shame open despair creek road again ice least",
  "contract": "save-together.wasm"
}
```

<details>
<summary><strong>Respuesta ejemplo:</strong> </summary>
<p>

```json
{
  "status": {
    "SuccessValue": ""
  },
  "transaction": {
    "signer_id": "dev-1636081698178-54540899156051",
    "public_key": "ed25519:Cgg4i7ciid8uG4K5Vnjzy5N4PXLst5aeH9ApRAUA3y8U",
    "nonce": 5,
    "receiver_id": "dev-1636081698178-54540899156051",
    "actions": [
      {
        "DeployContract": {
          "code": "hT9saWV3aok50F8JundSIWAW+lxOcBOns1zenB2fB4E="
        }
      }
    ],
    "signature": "ed25519:3VrppDV8zMMRXErdBJVU9MMbbKZ4SK1pBZqXoyw3oSSiXTeyR2W7upNhhZPdFJ1tNBr9h9SnsTVeBm5W9Bhaemis",
    "hash": "HbokHoCGcjGQZrz8yU8QDqBeAm5BN8iPjaSMXu7Yp2KY"
  },
  "transaction_outcome": {
    "proof": [
      {
        "hash": "Dfjn2ro1dXrPqgzd5zU7eJpCMKnATm295ceocX73Qiqn",
        "direction": "Right"
      },
      {
        "hash": "9raAgMrEmLpL6uiynMAi9rykJrXPEZN4WSxLJUJXbipY",
        "direction": "Right"
      }
    ],
    "block_hash": "B64cQPDNkwiCcN3SGXU2U5Jz5M9EKF1hC6uDi4S15Fb3",
    "id": "HbokHoCGcjGQZrz8yU8QDqBeAm5BN8iPjaSMXu7Yp2KY",
    "outcome": {
      "logs": [],
      "receipt_ids": ["D94GcZVXE2WgPGuaJPJq8MdeEUidrN1FPkuU75NXWm7X"],
      "gas_burnt": 1733951676474,
      "tokens_burnt": "173395167647400000000",
      "executor_id": "dev-1636081698178-54540899156051",
      "status": {
        "SuccessReceiptId": "D94GcZVXE2WgPGuaJPJq8MdeEUidrN1FPkuU75NXWm7X"
      }
    }
  },
  "receipts_outcome": [
    {
      "proof": [
        {
          "hash": "3HLkv7KrQ9LPptX658QiwkFagv8NwjcxF6ti15Een4uh",
          "direction": "Left"
        },
        {
          "hash": "9raAgMrEmLpL6uiynMAi9rykJrXPEZN4WSxLJUJXbipY",
          "direction": "Right"
        }
      ],
      "block_hash": "B64cQPDNkwiCcN3SGXU2U5Jz5M9EKF1hC6uDi4S15Fb3",
      "id": "D94GcZVXE2WgPGuaJPJq8MdeEUidrN1FPkuU75NXWm7X",
      "outcome": {
        "logs": [],
        "receipt_ids": [],
        "gas_burnt": 1733951676474,
        "tokens_burnt": "173395167647400000000",
        "executor_id": "dev-1636081698178-54540899156051",
        "status": {
          "SuccessValue": ""
        }
      }
    }
  ]
}
```

</p>
</details>

---

## `/addProduct`

> _Agrega un producto al listado en el storage del blockchain._

**Method:** **`POST`**

| Param                            | Description                                                                                                           |
| -------------------------------- | --------------------------------------------------------------------------------------------------------------------- |
| `account_id`                     | _Cuenta que ejecutara el llamado al metodo del contrato y pagara el costo en gas._              |
| `seed_phrase` _O_ `private_key` | _Seed phrase O private key del id de la cuenta indicada en account_id._                                                                 |
| `contract`                       | _Account id del contrato que estas llamando._                                                               |
| `method`                         | _Metodo publico correspondiente al contrato que se esta mandando llamar._                                                       |
| `params`                         | _Argumentos del metodo que se manda llamar. Su uso es opcional._                             |

Example:

```json
{
  "account_id": "dev-1636081698178-54540899156051",
  "private_key": "2Kh6PJjxH5PTTsVnYqtgnnwXHeafvVGczDXoCb33ws8reyq8J4oBYix1KP2ugRQ7q9NQUyPcVFTtbSG3ARVKETfK",
  "contract": "dev-1636081698178-54540899156051",
  "method": "addProduct",
  "params": { "name":"Tortillas","price":"15","store":"Soriana","myListId":"102" }
}
```


<details>
<summary><strong>Respuesta ejemplo:</strong> </summary>
<p>

```json
{
    "isError": false,
    "message": "",
    "id": 0,
    "exist": false,
    "rows": [],
    "code": 200,
    "modelo": {
        "receipts_outcome": [
            {
                "block_hash": "5Qd3KaCW5Tk1WSTUoew1cM62nLQC6HpSc84VWD1As9D2",
                "id": "D55c6pHkxx8yPXPvcAeAwkGP5zMZu8adYGkzPsAyBFgi",
                "outcome": {
                    "executor_id": "dev-1636077519984-29378305835325",
                    "gas_burnt": 5456675905386,
                    "logs": [],
                    "metadata": {
                        "gas_profile": [
                            {
                                "cost": "BASE",
                                "cost_category": "WASM_HOST_COST",
                                "gas_used": "2647681110"
                            },
                            {
                                "cost": "CONTRACT_COMPILE_BASE",
                                "cost_category": "WASM_HOST_COST",
                                "gas_used": "35445963"
                            },
                            {
                                "cost": "CONTRACT_COMPILE_BYTES",
                                "cost_category": "WASM_HOST_COST",
                                "gas_used": "3903234000"
                            },
                            {
                                "cost": "READ_MEMORY_BASE",
                                "cost_category": "WASM_HOST_COST",
                                "gas_used": "20878905600"
                            },
                            {
                                "cost": "READ_MEMORY_BYTE",
                                "cost_category": "WASM_HOST_COST",
                                "gas_used": "604411947"
                            },
                            {
                                "cost": "WRITE_MEMORY_BASE",
                                "cost_category": "WASM_HOST_COST",
                                "gas_used": "5607589722"
                            },
                            {
                                "cost": "WRITE_MEMORY_BYTE",
                                "cost_category": "WASM_HOST_COST",
                                "gas_used": "204282900"
                            },
                            {
                                "cost": "READ_REGISTER_BASE",
                                "cost_category": "WASM_HOST_COST",
                                "gas_used": "5034330372"
                            },
                            {
                                "cost": "READ_REGISTER_BYTE",
                                "cost_category": "WASM_HOST_COST",
                                "gas_used": "7392150"
                            },
                            {
                                "cost": "WRITE_REGISTER_BASE",
                                "cost_category": "WASM_HOST_COST",
                                "gas_used": "8596567458"
                            },
                            {
                                "cost": "WRITE_REGISTER_BYTE",
                                "cost_category": "WASM_HOST_COST",
                                "gas_used": "288918864"
                            },
                            {
                                "cost": "STORAGE_WRITE_BASE",
                                "cost_category": "WASM_HOST_COST",
                                "gas_used": "192590208000"
                            },
                            {
                                "cost": "STORAGE_WRITE_KEY_BYTE",
                                "cost_category": "WASM_HOST_COST",
                                "gas_used": "2325934611"
                            },
                            {
                                "cost": "STORAGE_WRITE_VALUE_BYTE",
                                "cost_category": "WASM_HOST_COST",
                                "gas_used": "3256946595"
                            },
                            {
                                "cost": "STORAGE_WRITE_EVICTED_BYTE",
                                "cost_category": "WASM_HOST_COST",
                                "gas_used": "32117307"
                            },
                            {
                                "cost": "STORAGE_READ_BASE",
                                "cost_category": "WASM_HOST_COST",
                                "gas_used": "56356845750"
                            },
                            {
                                "cost": "STORAGE_READ_KEY_BYTE",
                                "cost_category": "WASM_HOST_COST",
                                "gas_used": "402382929"
                            },
                            {
                                "cost": "STORAGE_READ_VALUE_BYTE",
                                "cost_category": "WASM_HOST_COST",
                                "gas_used": "5611005"
                            },
                            {
                                "cost": "STORAGE_HAS_KEY_BASE",
                                "cost_category": "WASM_HOST_COST",
                                "gas_used": "54039896625"
                            },
                            {
                                "cost": "STORAGE_HAS_KEY_BYTE",
                                "cost_category": "WASM_HOST_COST",
                                "gas_used": "246326760"
                            },
                            {
                                "cost": "TOUCHING_TRIE_NODE",
                                "cost_category": "WASM_HOST_COST",
                                "gas_used": "2334783609270"
                            }
                        ],
                        "version": 1
                    },
                    "receipt_ids": [
                        "5bczBo7YHqUGFRuqXf8QYUkATQu1tgSqhxtnAr76szD2"
                    ],
                    "status": {
                        "SuccessValue": ""
                    },
                    "tokens_burnt": "545667590538600000000"
                },
                "proof": [
                    {
                        "direction": "Left",
                        "hash": "AKAjEvJb2C6UFAXCokG76HKjacypLaWhomsVEgABCcmH"
                    }
                ]
            },
            {
                "block_hash": "jVnRvVu1SRQUXA16rRzJvsssLRi7Ui1shM6D2jtw2de",
                "id": "5bczBo7YHqUGFRuqXf8QYUkATQu1tgSqhxtnAr76szD2",
                "outcome": {
                    "executor_id": "dev-1636077519984-29378305835325",
                    "gas_burnt": 223182562500,
                    "logs": [],
                    "metadata": {
                        "gas_profile": [],
                        "version": 1
                    },
                    "receipt_ids": [],
                    "status": {
                        "SuccessValue": ""
                    },
                    "tokens_burnt": "0"
                },
                "proof": []
            }
        ],
        "status": {
            "SuccessValue": ""
        },
        "transaction": {
            "actions": [
                {
                    "FunctionCall": {
                        "args": "eyJuYW1lIjoiQkFUIERFIEJBU0VCQUxMIiwicHJpY2UiOiIyMzAiLCJzdG9yZSI6IldhbHRtYXJ0IiwibXlMaXN0SWQiOiI0In0=",
                        "deposit": "0",
                        "gas": 30000000000000,
                        "method_name": "addProduct"
                    }
                }
            ],
            "hash": "GGi7SMumYVwBnUHkEmFta1SCT9Tq1ZLCsB2hErAZ5yp8",
            "nonce": 70093263000023,
            "public_key": "ed25519:9VFReAeRicyUKjx3A6vFqScSAALB3utmG3gDzKx552Tt",
            "receiver_id": "dev-1636077519984-29378305835325",
            "signature": "ed25519:225G927xHshu3G2hGj1UTf926DxRvvQSK7cEefcdmk18scMLyepafxWqbYAhTqywCcTxpM9xGHua5ocx5zRA8Xq2",
            "signer_id": "dev-1636077519984-29378305835325"
        },
        "transaction_outcome": {
            "block_hash": "5Qd3KaCW5Tk1WSTUoew1cM62nLQC6HpSc84VWD1As9D2",
            "id": "GGi7SMumYVwBnUHkEmFta1SCT9Tq1ZLCsB2hErAZ5yp8",
            "outcome": {
                "executor_id": "dev-1636077519984-29378305835325",
                "gas_burnt": 2428108818456,
                "logs": [],
                "metadata": {
                    "gas_profile": null,
                    "version": 1
                },
                "receipt_ids": [
                    "D55c6pHkxx8yPXPvcAeAwkGP5zMZu8adYGkzPsAyBFgi"
                ],
                "status": {
                    "SuccessReceiptId": "D55c6pHkxx8yPXPvcAeAwkGP5zMZu8adYGkzPsAyBFgi"
                },
                "tokens_burnt": "242810881845600000000"
            },
            "proof": [
                {
                    "direction": "Right",
                    "hash": "5RGZ9x3jgBoLWKfQvHqQFjJUGACT8Lf9a4r9w6SXYKxP"
                }
            ]
        }
    },
    "request": [],
    "errors": []
}

```

</p>
</details>

---


## `/getAllProducts`

> _Obtiene un listado de productos almacenados en el storage del blockchain._

**Method:** **`POST`**

| Param                            | Description                                                                                                           |
| -------------------------------- | --------------------------------------------------------------------------------------------------------------------- |
| `account_id`                     | _Cuenta que ejecutara el llamado al metodo del contrato y pagara el costo en gas._              |
| `seed_phrase` _O_ `private_key` | _Seed phrase O private key del id de la cuenta indicada en account_id._                                                                 |
| `contract`                       | _Account id del contrato que estas llamando._                                                               |
| `method`                         | _Metodo publico correspondiente al contrato que se esta mandando llamar._                                                       |
| `params`                         | _Argumentos del metodo que se manda llamar. Su uso es opcional._                             |

Example:

```json
{
  "account_id": "dev-1636081698178-54540899156051",
  "private_key": "2Kh6PJjxH5PTTsVnYqtgnnwXHeafvVGczDXoCb33ws8reyq8J4oBYix1KP2ugRQ7q9NQUyPcVFTtbSG3ARVKETfK",
  "contract": "dev-1636081698178-54540899156051",
  "method": "getAllProducts"
}
```


<details>
<summary><strong>Respuesta ejemplo:</strong> </summary>
<p>

```json

```

</p>
</details>

---


## `/getAllProductsByListId`

> _Obtiene un listado de productos ordenados por categoria almacenados en el storage del blockchain._

**Method:** **`POST`**

| Param                            | Description                                                                                                           |
| -------------------------------- | --------------------------------------------------------------------------------------------------------------------- |
| `account_id`                     | _Cuenta que ejecutara el llamado al metodo del contrato y pagara el costo en gas._              |
| `seed_phrase` _O_ `private_key` | _Seed phrase O private key del id de la cuenta indicada en account_id._                                                                 |
| `contract`                       | _Account id del contrato que estas llamando._                                                               |
| `method`                         | _Metodo publico correspondiente al contrato que se esta mandando llamar._                                                       |
| `params`                         | _Argumentos del metodo que se manda llamar. Su uso es opcional._                             |

Example:

```json
{
  "account_id": "dev-1636081698178-54540899156051",
  "private_key": "2Kh6PJjxH5PTTsVnYqtgnnwXHeafvVGczDXoCb33ws8reyq8J4oBYix1KP2ugRQ7q9NQUyPcVFTtbSG3ARVKETfK",
  "contract": "dev-1636081698178-54540899156051",
  "method": "getAllProductsByListId",
	"params": {"listId":"102"}
}
```


<details>
<summary><strong>Respuesta ejemplo:</strong> </summary>
<p>

```json

```

</p>
</details>

---


## `/getProduct`

> _Obtiene un producto por id almacenado en el storage del blockchain._

**Method:** **`POST`**

| Param                            | Description                                                                                                           |
| -------------------------------- | --------------------------------------------------------------------------------------------------------------------- |
| `account_id`                     | _Cuenta que ejecutara el llamado al metodo del contrato y pagara el costo en gas._              |
| `seed_phrase` _O_ `private_key` | _Seed phrase O private key del id de la cuenta indicada en account_id._                                                                 |
| `contract`                       | _Account id del contrato que estas llamando._                                                               |
| `method`                         | _Metodo publico correspondiente al contrato que se esta mandando llamar._                                                       |
| `params`                         | _Argumentos del metodo que se manda llamar. Su uso es opcional._                             |

Example:

```json
{
  "account_id": "dev-1636081698178-54540899156051",
  "private_key": "2Kh6PJjxH5PTTsVnYqtgnnwXHeafvVGczDXoCb33ws8reyq8J4oBYix1KP2ugRQ7q9NQUyPcVFTtbSG3ARVKETfK",
  "contract": "dev-1636081698178-54540899156051",
  "method": "getProduct",
	"params": {"key":"0"}
}
```


<details>
<summary><strong>Respuesta ejemplo:</strong> </summary>
<p>

```json
{
    "isError": false,
    "message": "",
    "id": 0,
    "exist": false,
    "rows": [],
    "code": 200,
    "modelo": [],
    "request": [],
    "errors": [],
    "data": [
        {
            "id": "1",
            "name": "Balon de futbol",
            "price": "120",
            "store": "Soriana",
            "myListId": "4"
        },
        {
            "id": "2",
            "name": "Arroz los valles",
            "price": "35",
            "store": "Bodega Abarrey",
            "myListId": "1"
        },
        {
            "id": "3",
            "name": "BAT DE BASEBALL",
            "price": "230",
            "store": "Waltmart",
            "myListId": "4"
        }
    ]
}
```

</p>
</details>

---


## `/deleteProduct`

> _Obtiene un producto por id almacenado en el storage del blockchain._

**Method:** **`POST`**

| Param                            | Description                                                                                                           |
| -------------------------------- | --------------------------------------------------------------------------------------------------------------------- |
| `account_id`                     | _Cuenta que ejecutara el llamado al metodo del contrato y pagara el costo en gas._              |
| `seed_phrase` _O_ `private_key` | _Seed phrase O private key del id de la cuenta indicada en account_id._                                                                 |
| `contract`                       | _Account id del contrato que estas llamando._                                                               |
| `method`                         | _Metodo publico correspondiente al contrato que se esta mandando llamar._                                                       |
| `params`                         | _Argumentos del metodo que se manda llamar. Su uso es opcional._                             |

Example:

```json
{
  "account_id": "dev-1636081698178-54540899156051",
  "private_key": "2Kh6PJjxH5PTTsVnYqtgnnwXHeafvVGczDXoCb33ws8reyq8J4oBYix1KP2ugRQ7q9NQUyPcVFTtbSG3ARVKETfK",
  "contract": "dev-1636081698178-54540899156051",
  "method": "deleteProduct",
	"params": {"key":"0"}
}
```


<details>
<summary><strong>Respuesta ejemplo:</strong> </summary>
<p>

```json
{
    "isError": false,
    "message": "",
    "id": 0,
    "exist": false,
    "rows": [],
    "code": 200,
    "modelo": {
        "receipts_outcome": [
            {
                "block_hash": "3XdH6bxSNvybCb9GphS94GwtfVD9fSo56L239yGZ2CeD",
                "id": "A873A8pA3tf7U8cg9oi9Yz6rYMPq8X8YugN7AXwwfxX9",
                "outcome": {
                    "executor_id": "dev-1636077519984-29378305835325",
                    "gas_burnt": 7011999229704,
                    "logs": [],
                    "metadata": {
                        "gas_profile": [
                            {
                                "cost": "BASE",
                                "cost_category": "WASM_HOST_COST",
                                "gas_used": "4501057887"
                            },
                            {
                                "cost": "CONTRACT_COMPILE_BASE",
                                "cost_category": "WASM_HOST_COST",
                                "gas_used": "35445963"
                            },
                            {
                                "cost": "CONTRACT_COMPILE_BYTES",
                                "cost_category": "WASM_HOST_COST",
                                "gas_used": "3903234000"
                            },
                            {
                                "cost": "READ_MEMORY_BASE",
                                "cost_category": "WASM_HOST_COST",
                                "gas_used": "23488768800"
                            },
                            {
                                "cost": "READ_MEMORY_BYTE",
                                "cost_category": "WASM_HOST_COST",
                                "gas_used": "330715971"
                            },
                            {
                                "cost": "WRITE_MEMORY_BASE",
                                "cost_category": "WASM_HOST_COST",
                                "gas_used": "11215179444"
                            },
                            {
                                "cost": "WRITE_MEMORY_BYTE",
                                "cost_category": "WASM_HOST_COST",
                                "gas_used": "315957552"
                            },
                            {
                                "cost": "READ_REGISTER_BASE",
                                "cost_category": "WASM_HOST_COST",
                                "gas_used": "10068660744"
                            },
                            {
                                "cost": "READ_REGISTER_BYTE",
                                "cost_category": "WASM_HOST_COST",
                                "gas_used": "11433192"
                            },
                            {
                                "cost": "WRITE_REGISTER_BASE",
                                "cost_category": "WASM_HOST_COST",
                                "gas_used": "20058657402"
                            },
                            {
                                "cost": "WRITE_REGISTER_BYTE",
                                "cost_category": "WASM_HOST_COST",
                                "gas_used": "840145644"
                            },
                            {
                                "cost": "STORAGE_WRITE_BASE",
                                "cost_category": "WASM_HOST_COST",
                                "gas_used": "64196736000"
                            },
                            {
                                "cost": "STORAGE_WRITE_KEY_BYTE",
                                "cost_category": "WASM_HOST_COST",
                                "gas_used": "916277271"
                            },
                            {
                                "cost": "STORAGE_WRITE_VALUE_BYTE",
                                "cost_category": "WASM_HOST_COST",
                                "gas_used": "31018539"
                            },
                            {
                                "cost": "STORAGE_WRITE_EVICTED_BYTE",
                                "cost_category": "WASM_HOST_COST",
                                "gas_used": "32117307"
                            },
                            {
                                "cost": "STORAGE_READ_BASE",
                                "cost_category": "WASM_HOST_COST",
                                "gas_used": "169070537250"
                            },
                            {
                                "cost": "STORAGE_READ_KEY_BYTE",
                                "cost_category": "WASM_HOST_COST",
                                "gas_used": "1021433589"
                            },
                            {
                                "cost": "STORAGE_READ_VALUE_BYTE",
                                "cost_category": "WASM_HOST_COST",
                                "gas_used": "589155525"
                            },
                            {
                                "cost": "STORAGE_REMOVE_BASE",
                                "cost_category": "WASM_HOST_COST",
                                "gas_used": "106946061000"
                            },
                            {
                                "cost": "STORAGE_REMOVE_KEY_BYTE",
                                "cost_category": "WASM_HOST_COST",
                                "gas_used": "764407680"
                            },
                            {
                                "cost": "STORAGE_REMOVE_RET_VALUE_BYTE",
                                "cost_category": "WASM_HOST_COST",
                                "gas_used": "1199281824"
                            },
                            {
                                "cost": "STORAGE_HAS_KEY_BASE",
                                "cost_category": "WASM_HOST_COST",
                                "gas_used": "108079793250"
                            },
                            {
                                "cost": "STORAGE_HAS_KEY_BYTE",
                                "cost_category": "WASM_HOST_COST",
                                "gas_used": "615816900"
                            },
                            {
                                "cost": "TOUCHING_TRIE_NODE",
                                "cost_category": "WASM_HOST_COST",
                                "gas_used": "3880571378166"
                            }
                        ],
                        "version": 1
                    },
                    "receipt_ids": [
                        "HVQqC8zMJxnhhciFppgdFxbAsMd3vv8boByDaZK77L1J"
                    ],
                    "status": {
                        "SuccessValue": ""
                    },
                    "tokens_burnt": "701199922970400000000"
                },
                "proof": [
                    {
                        "direction": "Left",
                        "hash": "Efcneb7gaGwzyYNarcHEBjrZXSUFZn2bt8SvcGHGACEt"
                    }
                ]
            },
            {
                "block_hash": "F4zRgUy7c7jMYEnEVvG2zVsyjHEDQEbeXbDrVdkGxs8s",
                "id": "HVQqC8zMJxnhhciFppgdFxbAsMd3vv8boByDaZK77L1J",
                "outcome": {
                    "executor_id": "dev-1636077519984-29378305835325",
                    "gas_burnt": 223182562500,
                    "logs": [],
                    "metadata": {
                        "gas_profile": [],
                        "version": 1
                    },
                    "receipt_ids": [],
                    "status": {
                        "SuccessValue": ""
                    },
                    "tokens_burnt": "0"
                },
                "proof": []
            }
        ],
        "status": {
            "SuccessValue": ""
        },
        "transaction": {
            "actions": [
                {
                    "FunctionCall": {
                        "args": "eyJrZXkiOiIzIn0=",
                        "deposit": "0",
                        "gas": 30000000000000,
                        "method_name": "deleteProduct"
                    }
                }
            ],
            "hash": "4USCGvowa6VFwTo8b4t81fEk969jfL9ZCPjXXpZTCfLN",
            "nonce": 70093263000024,
            "public_key": "ed25519:9VFReAeRicyUKjx3A6vFqScSAALB3utmG3gDzKx552Tt",
            "receiver_id": "dev-1636077519984-29378305835325",
            "signature": "ed25519:4mHm3w7yi3a4rxUENCeV6KxV2FXTAu5PJPXyBjvfzz2bLysnfkWZxHNvbZAdh2LJ8GGEvfSsPiPoDpZkrqUkDYb9",
            "signer_id": "dev-1636077519984-29378305835325"
        },
        "transaction_outcome": {
            "block_hash": "3XdH6bxSNvybCb9GphS94GwtfVD9fSo56L239yGZ2CeD",
            "id": "4USCGvowa6VFwTo8b4t81fEk969jfL9ZCPjXXpZTCfLN",
            "outcome": {
                "executor_id": "dev-1636077519984-29378305835325",
                "gas_burnt": 2427974662416,
                "logs": [],
                "metadata": {
                    "gas_profile": null,
                    "version": 1
                },
                "receipt_ids": [
                    "A873A8pA3tf7U8cg9oi9Yz6rYMPq8X8YugN7AXwwfxX9"
                ],
                "status": {
                    "SuccessReceiptId": "A873A8pA3tf7U8cg9oi9Yz6rYMPq8X8YugN7AXwwfxX9"
                },
                "tokens_burnt": "242797466241600000000"
            },
            "proof": [
                {
                    "direction": "Right",
                    "hash": "GGWiS8wbPRzG5iYcFAovA9NrwCCH37iZ9sVkWdCrBvCT"
                }
            ]
        }
    },
    "request": [],
    "errors": []
}
```

</p>
</details>
