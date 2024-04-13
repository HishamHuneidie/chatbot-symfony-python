import random
import string

import nltk
import spacy
import unicodedata
from sklearn.feature_extraction.text import TfidfVectorizer
from sklearn.metrics.pairwise import cosine_similarity

# Load spanish model for spacy
nlp = spacy.load('es_core_news_sm')

# Read corpus
file = open('/app/public/raw/corpus.txt')
content = file.read()
# Creating tokens
tokenPhases = nltk.sent_tokenize(content)
tokenWords = nltk.word_tokenize(content)
lemmer = nltk.stem.WordNetLemmatizer()


def LemTokens(tokens):
    return [lemmer.lemmatize(token) for token in tokens]


def stopWords():
    stop_words = spacy.lang.es.stop_words.STOP_WORDS
    return [LemNormalize(word)[0] for word in stop_words]


remove_punt_dict = dict((ord(punct), None) for punct in string.punctuation)


def LemNormalize(text):
    remove_accents = lambda text: ''.join(
        char for char in unicodedata.normalize('NFD', text) if unicodedata.category(char) != 'Mn')
    text = remove_accents(text)
    doc = nlp(text)
    return [token.lemma_ for token in doc if not token.is_punct]


def response(userRequest):
    # Join user tokens
    tokenPhases.append(userRequest)
    TfidfVec = TfidfVectorizer(tokenizer=LemNormalize, stop_words=stopWords())
    tfidf = TfidfVec.fit_transform(tokenPhases)

    # Evaluate similarity
    vals = cosine_similarity(tfidf[-1], tfidf)
    idx = vals.argsort()[0][-2]
    flat = vals.flatten()
    flat.sort()
    req_tfidf = flat[-2]

    # default response
    if (req_tfidf == 0):
        return "Sorry, but I can't understand you. Please try again"

    # response
    return tokenPhases[idx]


def defaultAnswer(sentence, inputs, outputs):
    for word in sentence.split():
        if word.lower() in inputs:
            return random.choice(outputs)


INPUT_REGARDS = ["hola", "buenas", "saludos", "que tal", "hey", "buenos dias"]
OUTPUT_REGARDS = ["Hola", "Hola, ¿Qué tal?", "Hola ¿Cómo te puedo ayudar?", "Hola, encantado de hablar contigo"]


def regards(sentence):
    return defaultAnswer(sentence, INPUT_REGARDS, OUTPUT_REGARDS)


INPUT_GRATITUDE = ["gracias", "muchas gracias"]
OUTPUT_GRATITUDE = ["No hay de que"]


def gratitudes(sentence):
    return defaultAnswer(sentence, INPUT_GRATITUDE, OUTPUT_GRATITUDE)


def processRequest(userRequest):
    userRequest = userRequest.lower()

    if (userRequest != 'off'):
        if (gratitudes(userRequest) != None):
            return gratitudes(userRequest)
        elif (regards(userRequest) != None):
            return regards(userRequest)
        else:
            res = response(userRequest)
            tokenPhases.remove(userRequest)
            return res
    else:
        return "bye bye"
