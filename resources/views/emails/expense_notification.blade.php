@component('mail::message')
# Uma Nova Despesa Foi Criada

Aqui estão os detalhes da sua despesa:

@component('mail::table')
| Campo       | Detalhes         |
|-------------|------------------|
| ID          | {{ $expense->id }}   |
| Descrição   | {{ $expense->description }} |
| Data        | {{ $expense->date }}  |
| Valor       | R$ {{ number_format($expense->value, 2, ',', '.') }} |
@endcomponent

Obrigado por usar nosso aplicativo!
@endcomponent