import pandas as pd
import numpy  as np

df_buques      = pd.read_csv('buques.csv')
df_itinerarios = pd.read_csv('itinerarios.csv')
df_personal    = pd.read_csv('personal_buque.csv')

#Tabla de paises - Entidad.
df_paises_buques = df_buques[['pais']]
df_paises_navieras = df_buques[['pais_naviera']].rename(columns={'pais_naviera':'pais'}, inplace=True)

df_paises = pd.concat([df_paises_buques, df_paises_navieras])
df_paises = df_paises.drop_duplicates()
df_paises = df_paises.reset_index()
df_paises.insert(0, 'paid', range(0, len(df_paises)))
df_paises = df_paises.drop(columns='index')


#Tabla de navieras - Entidad.df_paises = df_paises.to_frame()
df_navieras = df_buques[['nombre_naviera','pais_naviera','descripcion_naviera']]
df_navieras = df_navieras.drop_duplicates()
df_navieras = df_navieras.reset_index()
df_navieras.insert(0, 'nid', range(0, len(df_navieras)))
df_navieras = df_navieras.drop(columns='index')

#Tabla de Puertos - Entidad.
df_puertos = df_itinerarios['nombre_puerto'] 
df_puertos = df_puertos.drop_duplicates()
df_puertos = df_puertos.reset_index()
df_puertos.insert(0, 'pid', range(0, len(df_puertos)))
df_puertos = df_puertos.drop(columns='index')

#Tabla de Personas - Entidad
df_personas = df_personal[['id_personal','nombre','nacionalidad','pasaporte','edad','genero']]
df_personas.rename(columns={'id_personal':'pid'}, inplace=True)

#Tabla de Buques - Entidad
df_buques_father = df_buques[['id_buque','nombre','patente','pais']]
df_buques_father.rename(columns={'id_buque':'bid'}, inplace=True)

#Tabla de Buques Pesquero - Entidad
pesqueros = df_buques['tipo'] == 'pesquero'
df_buques_pesqueros = df_buques[pesqueros]
df_buques_pesqueros = df_buques_pesqueros.reset_index()
df_buques_pesqueros = df_buques_pesqueros[['id_buque','tipo_pesca']]
df_buques_pesqueros.rename(columns={'id_buque':'bid'}, inplace=True)

#Tabla de Buques Carga - Entidad
cargueros = df_buques['tipo'] == 'carga'
df_buques_cargueros = df_buques[cargueros]
df_buques_cargueros = df_buques_cargueros.reset_index()
df_buques_cargueros = df_buques_cargueros[['id_buque','max_containers','max_ton']]
df_buques_cargueros.rename(columns={'id_buque':'bid'}, inplace=True)

#Tabla de Buques Petrolero - Entidad
petroleros = df_buques['tipo'] == 'petrolero'
df_buques_petroleros = df_buques[petroleros]
df_buques_petroleros = df_buques_petroleros.reset_index()
df_buques_petroleros = df_buques_petroleros[['id_buque','max_lit']]
df_buques_petroleros.rename(columns={'id_buque':'bid'}, inplace=True)

#Tabla de Trabaja_en - Relacion

df_trabaja_en = df_personal[['id_personal','id_buque']]
df_trabaja_en.rename(columns={'id_personal':'pid','id_buque':'bid'}, inplace=True)

#Tabla de Capitan_en - Relacion
df_capitan_en = df_buques[['id_capitan','id_buque']]
df_capitan_en.rename(columns={'id_capitan':'pid','id_buque':'bid'}, inplace=True)

#Tabla de Pertenece_a - Relacion

df_join = pd.merge(df_buques, df_navieras, on='nombre_naviera', how='right')
df_pertenece_a = df_join[['id_buque', 'nid']]
df_pertenece_a.rename(columns={'id_buque':'bid'}, inplace=True)

#Tabla de Itinerario - Relacion
df_join = pd.merge(df_itinerarios, df_puertos, on='nombre_puerto', how='right')
df_itinerarios = df_join[['id_buque','pid', 'fecha_atraque', 'fecha_salida']]
df_itinerarios.rename(columns={'id_buque':'bid'}, inplace=True)
df_prox_itinerarios = df_itinerarios[df_itinerarios['fecha_salida'].isna()]
df_prox_itinerarios = df_prox_itinerarios[["bid","pid","fecha_atraque"]]
df_atraque = df_itinerarios[df_itinerarios['fecha_salida'].notna()]


df_paises.to_csv('Tablas/paises.csv', index=False)
df_navieras.to_csv('Tablas/navieras.csv', index=False)
df_puertos.to_csv('Tablas/puertos.csv', index=False)
df_personas.to_csv('Tablas/personas.csv', index=False)
df_buques_father.to_csv('Tablas/buques_father.csv', index=False)
df_buques_pesqueros.to_csv('Tablas/buques_pesqueros.csv', index=False)
df_buques_cargueros.to_csv('Tablas/buques_cargueros.csv', index=False)
df_buques_petroleros.to_csv('Tablas/buques_petroleros.csv', index=False)
df_prox_itinerarios.to_csv('Tablas/prox_itinerarios.csv', index=False)
df_atraque.to_csv('Tablas/atraque.csv', index=False)

df_trabaja_en.to_csv('Tablas/trabaja_en.csv', index=False)
df_capitan_en.to_csv('Tablas/capitan_en.csv', index=False)
df_pertenece_a.to_csv('Tablas/pertenece_a.csv', index=False)
