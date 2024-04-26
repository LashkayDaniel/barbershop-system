const currencyFormat = (number) => {
    return new Intl.NumberFormat('uk-UA', {style: 'currency', currency: 'UAH'}).format(number)
}

export {currencyFormat}
