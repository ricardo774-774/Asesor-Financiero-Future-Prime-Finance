from sklearn.tree import DecisionTreeRegressor
from datetime import datetime as dt
from flask import Flask, request, jsonify
import numpy as np
import pandas as pd
from flask_cors import CORS

app = Flask(__name__)
CORS(app)

# Cargar los datos de data_100.csv una vez
csv_data = pd.read_csv('data_100.csv')
fechas_csv = pd.to_datetime(csv_data['Fecha'], format='%Y-%m-%d').apply(lambda x: x.toordinal()).values
balances_csv = csv_data['Balance'].values

@app.route('/suggest_savings', methods=['POST'])
def suggest_savings():
    # Obtener los datos de la solicitud del usuario
    data = request.get_json(force=True)
    
    # Extraer las fechas proporcionadas por el usuario y convertirlas a formato ordinal
    fechas_user = np.array([dt.strptime(fecha, '%Y-%m-%d').toordinal() for fecha in data['X']])
    balances_user = np.array(data['y'])  # Balance final en cada fecha específica
    
    # Crear y entrenar un modelo de árbol de decisión
    model_user = DecisionTreeRegressor(max_depth=5)  # Puedes ajustar max_depth
    model_user.fit(fechas_user.reshape(-1, 1), balances_user)
    
    model_csv = DecisionTreeRegressor(max_depth=5)
    model_csv.fit(fechas_csv.reshape(-1, 1), balances_csv)
    
    # Meta financiera proporcionada por el usuario
    dinero_meta = data['dinero_meta']
    # Fecha objetivo proporcionada por el usuario
    fecha_meta = dt.strptime(data['fecha_meta'], '%d-%m-%Y').toordinal()

    # Predicciones de ambos modelos en la fecha objetivo
    prediccion_user = model_user.predict([[fecha_meta]])[0]
    prediccion_csv = model_csv.predict([[fecha_meta]])[0]

    # Promedio ponderado de las predicciones (50% cada uno)
    prediccion_final = (prediccion_user + prediccion_csv) / 2
    
    # Calcular el dinero que falta para alcanzar la meta
    dinero_faltante = dinero_meta - prediccion_final
    # Calcular los días que faltan hasta la fecha objetivo
    dias_faltantes = fecha_meta - fechas_user[-1]
    
    # Calcular el ahorro o ingreso extra necesario por día
    ahorro_extra_diario_necesario = dinero_faltante / dias_faltantes
    
    # Calcular el ahorro o ingreso extra necesario por mes
    ahorro_extra_mensual_necesario = ahorro_extra_diario_necesario * 30
    
    # Retornar el resultado en formato JSON
    return jsonify({
        'ahorro_extra_mensual_necesario': ahorro_extra_mensual_necesario.item(),
        'ahorro_extra_diario_necesario': ahorro_extra_diario_necesario.item()
    })

if __name__ == '__main__':
    app.run(debug=True)