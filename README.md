# 創想知識後臺Excel匯入模板
## 環境需求
1. Laravel > 9.0
1. PHP > 8.1

## 環境配置
1. `vi composer.json`
2. `add`
    ```json
        "repositories": {
            "cpkm/excel": {
                "type": "vcs",
                "url": "git@github.com:cpkm-service/excel.git"
            }
        }
    ```
3. `composer require cpkm-service/excel`
4. `php artisan migrate`

